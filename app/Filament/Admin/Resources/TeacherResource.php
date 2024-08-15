<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeacherResource\Pages;
use App\Filament\Admin\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationLabel = 'Profesores';
    protected static ?string $modelLabel = 'Profesor';
    protected static ?string $pluralModelLabel = 'Profesores';
   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(auth()->user()->id),

                Section::make('')
                ->description('Información del Docente')
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

                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->label('Especialidad')
                                 ->columnSpan(4)
                                ->maxLength(255),
                           



                                Forms\Components\Radio::make('sex')
                                        ->label('Género')
                                        ->options([
                                            'Mujer' => 'Mujer',
                                            'Hombre' => 'Hombre',
                                            'Indefinido' => 'Indefinido'
                                        ])
                                        ->columnSpan(3)
                                        ->required()
                                        ->default('Mujer')
                                        ->inline(),


                                    Forms\Components\DatePicker::make('dateOfBirday')
                                        ->label('Fecha de Nac.')
                                        ->columnSpan(3)
                                        ->required()
                                        ->reactive() // Este método es necesario para activar el evento afterStateUpdated
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            if ($state) {
                                                $age = Carbon::parse($state)->age;
                                                $set('age', $age);
                                            }
                                        }),
                                        
                                    Forms\Components\TextInput::make('age')
                                        ->label('Edad')
                                        ->columnSpan(1)
                                        ->readOnly(),

                                    Forms\Components\TextInput::make('address')
                                        ->label('Dirección')
                                        ->columnSpan(5)
                                        ->required()
                                        ->maxLength(255),
                        ]),                 


                

                ]),


                  Section::make('')
                    ->description('Información de Contacto')
                    ->schema([
                         Grid::make(12)
                        ->schema([                         
                         
                         Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->columnSpan(4)
                                ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->columnSpan(4)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('celular')
                            ->columnSpan(4)
                            ->maxLength(255),
                       

                                
                          ])
                ]),


                Section::make('')
                    ->description('Información Médica y de Emergencia')
                    ->schema([
                         Grid::make(2)
                        ->schema([                         
                        
                        Forms\Components\TextInput::make('emergencyConcatName')
                            ->label('Contacto de Emergencia')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergencyConcatPhone')
                            ->label('Teléfono de Emergencia')
                            ->maxLength(255),
                                
                          ])
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
                    ->description(fn (Teacher $record): string => $record->name)
                    ->searchable(),       

                Tables\Columns\TextColumn::make('title')
                    ->label('Especialidad')
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
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
