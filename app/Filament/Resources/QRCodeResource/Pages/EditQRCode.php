<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;

class EditQRCode extends EditRecord
{
    protected static string $resource = QRCodeResource::class;

    /**
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('preview')
                ->action(fn () => $this->record->advance())
                ->icon('heroicon-o-document-download')
                ->modalHeading('Preview QR-code')
                ->modalButton('Download')
                ->modalContent(view('filament.pages.actions.preview', [
                    'record' => $this->record,
                ]))
        ];
    }
}
