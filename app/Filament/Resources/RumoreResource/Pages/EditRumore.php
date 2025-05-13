<?php

namespace App\Filament\Resources\RumoreResource\Pages;

use App\Filament\Resources\RumoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRumore extends EditRecord
{
    protected static string $resource = RumoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
