<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Filament\Admin\Resources\StudentResource\RelationManagers;
use App\Models\Student;
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
use Carbon\Carbon;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    
     protected static ?string $navigationLabel = 'Alumnos';
    protected static ?string $modelLabel = 'Alumno';
    protected static ?string $pluralModelLabel = 'Alumnos';
    protected static ?string $navigationGroup = 'Gestión de Alumnos';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $studentCount = Student::all()->count();
        
        return $form
            ->schema([

             Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(auth()->user()->id),

            Section::make('')
                ->description('Información del Alumno')
                ->schema([
                     Grid::make(12)
                    ->schema([ 

                            Forms\Components\TextInput::make('code')
                                ->default('EST-' . date('Y') . '-' . $studentCount + 1)
                                ->label('Código')
                                ->required()
                                ->columnSpan(2)
                                ->readOnly()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('name')
                                ->label('Nombre')
                                ->required()
                                ->columnSpan(3)
                                ->maxLength(255),
                            Forms\Components\TextInput::make('surname')
                                ->label('Apellido')
                                ->required()
                                ->columnSpan(3)
                                ->maxLength(255),

                            Forms\Components\Select::make('tutor_id')
                                ->label('Tutor')
                                ->columnSpan(4)
                                ->options(Tutor::all()->pluck('name', 'id'))    
                                ->searchable()               
                                ->required(),



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
                ->description('Información Médica y de Emergencia')
                ->schema([
                     Grid::make(2)
                    ->schema([ 

                        Forms\Components\RichEditor::make('medicalInfo')
                            ->label('Información Médica')
                            ->maxLength(65535)
                            ->disableToolbarButtons([
                                'blockquote',
                                'attachFiles',
                                'codeBlock',
                            ])
                            ->columnSpanFull(),
                        
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
                Tables\Columns\TextColumn::make('tutors.name')
                    ->label('Tutor')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('surname')
                    ->label('Nombre')
                    ->description(fn (Student $record): string => $record->name)
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
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
