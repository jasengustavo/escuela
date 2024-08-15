<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TutorResource\Pages;
use App\Filament\Admin\Resources\TutorResource\RelationManagers;
use App\Models\Tutor;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

   
    protected static ?string $navigationLabel = 'Representante';
    protected static ?string $modelLabel = 'Representante';
    protected static ?string $pluralModelLabel = 'Representantes';
    protected static ?string $navigationGroup = 'Gestión de Alumnos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(auth()->user()->id),

             Section::make('')
                ->description('Información del Contacto')
                ->schema([

                Grid::make(12)
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->columnSpan(4)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('surname')
                            ->label('Apellido')
                            ->required()
                             ->columnSpan(4)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dniType')
                            ->label('Doc.')
                            ->columnSpan(1)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dniNumber')
                            ->label('Número')
                            ->columnSpan(3)
                            ->maxLength(255),
                     ]),

                Grid::make(12)
                    ->schema([ 

                            Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->columnSpan(4)
                                ->maxLength(255),
                             Forms\Components\TextInput::make('address')
                                ->label('Dirección')
                                ->required()
                                ->columnSpan(4)
                                ->maxLength(255),
                            Forms\Components\TextInput::make('phone')
                                ->label('Teléfono')
                                ->tel()
                                ->columnSpan(2)
                                ->maxLength(255),
                            Forms\Components\TextInput::make('celular')
                                ->label('Celular')
                                ->tel()
                                ->columnSpan(2)
                                ->maxLength(255),
                    ]),

                    ]),
            
                 Section::make('')
                    ->description('Información de Emergencia')
                    ->schema([

                        Grid::make(12)

                            ->schema([ 

                                    Forms\Components\TextInput::make('emergencyConcatName')
                                        ->label('Nombre del Contacto')
                                        ->columnSpan(6)
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('emergencyConcatPhone')
                                        ->label('Teléfono')
                                        ->columnSpan(2)
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('relation')
                                        ->label('Relación')
                                        ->columnSpan(4)
                                        ->required()
                                        ->maxLength(255),
                                        ]),               

                            ]),
               
                        ]);
                 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('users.name')
                    ->label('Usuario')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Nombre')
                    ->description(fn (Tutor $record): string => $record->name)
                    ->searchable(),                 
                Tables\Columns\TextColumn::make('email')   
                    ->label('Email')  
                    ->icon('heroicon-o-envelope')   
                    ->color('warning')         
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfonos')
                    ->description(fn (Tutor $record): string => $record->celular)
                    ->searchable(),
               
               
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Estado'),
               
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(date('d.m.Y H:m'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
               
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }
}
