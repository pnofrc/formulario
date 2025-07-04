<?php

namespace App\Filament\Resources\OspitalitaResource\Pages;

use App\Filament\Resources\OspitalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOspitalitas extends ListRecords
{
    protected static string $resource = OspitalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
