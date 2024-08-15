<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    //protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Configuración';
    protected static ?string $modelLabel = 'Información';
    protected static ?string $navigationGroup = 'Sistema';
    protected ?string $heading = 'Información Web';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.admin.pages.settings';

   
}
