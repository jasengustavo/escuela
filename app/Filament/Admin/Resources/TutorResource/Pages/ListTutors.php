<?php

namespace App\Filament\Admin\Resources\TutorResource\Pages;

use App\Filament\Admin\Resources\TutorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTutors extends ListRecords
{
    protected static string $resource = TutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
