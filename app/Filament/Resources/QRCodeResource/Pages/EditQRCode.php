<?php

namespace App\Filament\Resources\QRCodeResource\Pages;

use App\Filament\Resources\QRCodeResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
                ->action(function() {
                    QrCode::size($this->record->size)
                        ->color($this->record->getColorRGB()['r'], $this->record->getColorRGB()['g'], $this->record->getColorRGB()['b'])
                        ->backgroundColor($this->record->getBackgroundColorRGB()['r'], $this->record->getBackgroundColorRGB()['g'], $this->record->getBackgroundColorRGB()['b'])
                        ->style($this->record->style)
                        ->eye($this->record->eye_style)
                        ->errorCorrection($this->record->error_correction_level)
                        ->generate($this->record->getContent(), storage_path('app/qr-codes/' . $this->record->id . '.svg'));
                    return response()->download(storage_path('app/qr-codes/' . $this->record->id . '.svg'));

                })
                ->icon('heroicon-o-document-download')
                ->modalHeading('Preview QR-code')
                ->modalButton('Download')
                ->modalContent(view('filament.pages.actions.preview', [
                    'record' => $this->record,
                ]))
        ];
    }
}
