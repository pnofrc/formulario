<?php

namespace App\Filament\Resources\QuaResource\Pages;

use App\Filament\Resources\QuaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQua extends EditRecord
{
    protected static string $resource = QuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
