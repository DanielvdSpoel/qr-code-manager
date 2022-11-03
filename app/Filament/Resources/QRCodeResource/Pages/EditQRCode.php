<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQRCode extends EditRecord
{
    protected static string $resource = QRCodeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
