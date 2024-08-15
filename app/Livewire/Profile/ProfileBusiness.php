<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProfileBusiness extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Profile $record;

    public function mount(): void
    {
        $this->record = Profile::where('business_id',auth()->user()->business_id)->first();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([


                 Grid::make(1)
                    ->schema([
                              Forms\Components\TextInput::make('name')
                                    ->label('Nombre para mostrar')
                                    ->required()
                                    ->maxLength(255),
                        ]),
                Grid::make(1)
                    ->schema([
                              Forms\Components\TextInput::make('address')
                                ->label('Dirección')
                                ->maxLength(255),
                        ]),
                Grid::make(3)
                    ->schema([
                              
                            Forms\Components\TextInput::make('city')
                                ->label('Ciudad')
                                ->default('San Rafael')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('province')
                                ->label('Provincia')
                                ->default('Mendoza')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('country')
                                ->label('Pais')
                                ->default('Argentina')
                                ->maxLength(255),
                        ]),
                Grid::make(2)
                    ->schema([
                              
                            Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('phone')
                                ->label('Teléfono de contacto')
                                ->numeric()
                                ->maxLength(255),
                        ]),
                
              
                
               
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

         Notification::make()
            ->title('Perfil actualizado correctamente')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.profile.profile-business');
    }
}
