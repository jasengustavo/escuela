<?php

namespace App\Livewire\Profile;

use Filament\Forms;
use App\Models\Setting;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class SettingBusiness extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Setting $record;

    public function mount(): void
    {
        $this->record = Setting::find(1);
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                 Grid::make(1)
                    ->schema([
                              Forms\Components\TextInput::make('name')
                                    ->label('Nombre de la Empresa')
                                    ->required()
                                    ->maxLength(255),
                        ]),


                     Grid::make(3)
                    ->schema([
                                Forms\Components\TextInput::make('address')
                                    ->label('Dirección')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('city')
                                    ->label('Ciudad')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('country')
                                    ->label('Provincia y País')
                                    ->maxLength(255),
                        ]),


                    Grid::make(2)
                    ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Whatsapp')
                                    ->tel()
                                    ->maxLength(255),
                        ]),

                Grid::make(2)
                    ->schema([  
               
                            FileUpload::make('logoLight')
                                ->label('Logo Claro')
                                ->image()
                                ->directory('settings')
                                ->imageEditor(),
                            FileUpload::make('logoDark')->image()
                                ->label('Logo Oscuro')
                                ->directory('settings')
                                ->imageEditor(),
                           
                    ]),

                Grid::make(2)
                    ->schema([  
               
                            FileUpload::make('favicon')->image()
                                ->label('Favicon')
                                ->directory('settings')
                                ->imageEditor(),
                            FileUpload::make('logoShared')->image()
                                ->label('Logo de Reportes')
                                ->directory('settings')
                                ->imageEditor(),
                    ])
                
            ])
            ->statePath('data')
            ->model($this->record);
    }

   public function save(): void
{
    $data = $this->form->getState();

    $this->record->update($data);

    Notification::make()
        ->title('Información actualizada correctamente')
        ->success()
        ->send();

    // Redirige después de enviar la notificación
     redirect('settings');
}


    public function render(): View
    {
        return view('livewire.profile.setting-business');
    }
}
