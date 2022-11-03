<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListQRCodes extends ListRecords
{
    protected static string $resource = QRCodeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTitle(): string
    {
        return "QR-codes";
    }

}
