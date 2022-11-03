<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QRCodesRelationManager extends RelationManager
{
    protected static string $relationship = 'QRCodes';

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?string $modelLabel = 'QR-code';
    protected static ?string $pluralModelLabel = 'QR-codes';


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
                    ->hidden(fn (Closure $get) => $get('type') !== 'other')
                    ->maxLength(255),
                Forms\Components\TextInput::make('content')
                    ->required()
                    ->label('Url')
                    ->url()
                    ->hidden(fn (Closure $get) => $get('type') !== 'url')
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
                            ->mask(fn (Mask $mask) => $mask
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
