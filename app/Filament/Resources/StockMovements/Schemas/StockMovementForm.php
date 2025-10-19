<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                // Select::make('user_id')
                //     ->relationship('user', 'name')
                //     ->searchable()
                //     ->default(auth()->id())
                //     ->disabled()
                //     ->preload()
                //     ->dehydrated()
                //     ->required(),
                ToggleButtons::make('type')
                    ->options([
                        'in' => 'Stock in',
                        'out' => 'Stock Out',
                    ])
                    ->colors([
                        'in' => 'success',
                        'out' => 'danger',
                    ])
                    ->grouped()
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('previous_stock')
                    ->required()
                    ->numeric(),
                TextInput::make('new_stock')
                    ->required()
                    ->numeric(),
                Textarea::make('reason')
                    ->rows(5)
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                DateTimePicker::make('movement_date')
                    ->required()
                    ->default(now()),
            ]);
    }
}
