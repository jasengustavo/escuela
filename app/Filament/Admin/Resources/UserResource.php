<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

   
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $pluralModelLabel = 'Usuarios';
    protected static ?string $navigationGroup = 'Sistema';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

        Section::make('')
            ->description('')
            ->schema([
                Grid::make(2)
                    ->schema([
                        
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre y Apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('role_id')
                            ->label('Rol')
                            ->options(Role::all()->pluck('name', 'id'))                   
                            ->required(),
                        
                    ]),

                Grid::make(5)
                    ->schema([

                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->label('Email')
                                ->required()
                                ->columnSpan(2)
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                            Forms\Components\TextInput::make('password')
                                ->label('Contraseña')
                                ->password()
                                ->columnSpan(2)
                                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                ->dehydrated(fn (?string $state): bool => filled($state)),

                            Forms\Components\Toggle::make('status')
                                ->label('Activo')
                                ->columnSpan(1)
                                ->default(true)
                                ->required(),
                         ]),

               ])
              

              
            ]);
    }

    public static function table(Table $table): Table
    {
         return $table
            ->query(function (User $query) {

                    return $query->where('role_id', 1);

                })
            ->columns([
               
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre Completo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(date('d.m.Y H:m'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime(date('d.m.Y H:m'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id','desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
