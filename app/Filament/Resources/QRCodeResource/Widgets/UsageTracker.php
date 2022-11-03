<?php

namespace App\Filament\Resources\QRCodeResource\Widgets;

use App\Models\QRCode;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UsageTracker extends BaseWidget
{
    public ?QRCode $record = null;

    protected function getCards(): array
    {
        return [
            Card::make('Usage today', $this->record ? $this->record->usages()->whereDate('created_at', Carbon::today())->count() : 0),
            Card::make('Usage last 7 days', $this->record ? $this->record->usages()->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])->count() : 0),
            Card::make('Usage last 31 days', $this->record ? $this->record->usages()->whereBetween('created_at', [Carbon::now()->subDays(31), Carbon::now()])->count() : 0),
        ];
    }}
