<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQRCode extends CreateRecord
{
    protected static string $resource = QRCodeResource::class;

    protected static ?string $title = 'Create QR-code';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
