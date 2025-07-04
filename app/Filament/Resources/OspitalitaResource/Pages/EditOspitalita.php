<?php

namespace App\Filament\Resources\OspitalitaResource\Pages;

use App\Filament\Resources\OspitalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOspitalita extends EditRecord
{
    protected static string $resource = OspitalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
