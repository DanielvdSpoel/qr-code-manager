<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QRCodeResource\Pages;
use App\Filament\Resources\QRCodeResource\RelationManagers;
use App\Filament\Resources\QRCodeResource\Widgets\UsageTracker;
use App\Models\QRCode;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QRCodeResource extends Resource
{
    protected static ?string $model = QRCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-qrcode';

    protected static ?string $navigationLabel = 'QR-codes';
    protected static ?string $modelLabel = 'QR-code';
    protected static ?string $pluralModelLabel = 'QR-codes';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereBelongsTo(auth()->user());
    }

    public static function getPluralModelLabel(): string
    {
        return 'QR-codes';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->required()
                    ->default('url')
                    ->reactive()
                    ->helperText("The 'url' type will allow for usage tracking")
                    ->options([
                        'url' => 'Url',
                        'other' => 'Other',
                    ]),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->hidden(fn(Closure $get) => $get('type') !== 'other')
                    ->maxLength(255),
                Forms\Components\TextInput::make('content')
                    ->required()
                    ->label('Url')
                    ->url()
                    ->hidden(fn(Closure $get) => $get('type') !== 'url')
                    ->maxLength(255),
                Fieldset::make('Settings')
                    ->schema([
                        ColorPicker::make('color')
                            ->default('#000000')
                            ->required(),
                        ColorPicker::make('background_color')
                            ->default('#ffffff')
                            ->required(),
                        Select::make('style')
                            ->required()
                            ->default('square')
                            ->options([
                                'square' => 'Square',
                                'dot' => 'Dot',
                                'round' => 'Round',
                            ]),
                        Select::make('eye_style')
                            ->required()
                            ->default('square')
                            ->options([
                                'square' => 'Square',
                                'circle' => 'Circle',
                            ]),
                        Forms\Components\TextInput::make('size')
                            ->required()
                            ->default('100')
                            ->suffix('pixels')
                            ->mask(fn(Mask $mask) => $mask
                                ->numeric()
                                ->integer() // Disallow decimal numbers.
                                ->minValue(1) // Set the minimum value that the number can be.
                            )
                            ->maxLength(255),
                        Select::make('error_correction_level')
                            ->required()
                            ->default('m')
                            ->options([
                                'l' => 'Low',
                                'm' => 'Medium',
                                'q' => 'Quartile',
                                'h' => 'High',
                            ]),
                        FileUpload::make('image')
                            ->image()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->searchable(),
                TextColumn::make('usages_count')
                    ->counts('usages')
                    ->label('Usages')
                    ->sortable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            UsageTracker::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQRCodes::route('/'),
            'create' => Pages\CreateQRCode::route('/create'),
            'edit' => Pages\EditQRCode::route('/{record}/edit'),
        ];
    }
}
