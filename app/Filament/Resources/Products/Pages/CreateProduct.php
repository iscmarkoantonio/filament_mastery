<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Enums\Operation;

class CreateProduct extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = ProductResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Initial infos')
                ->description('Give the category a clear and unique name')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('sku')
                        ->label('SKU')
                        ->required()
                        ->readOnly()
                        ->hiddenOn(Operation::Create),
                    Textarea::make('description')
                        ->columnSpanFull(),
                ])->columns(2),
            Step::make('Details')
                ->description('Provided detaild information about the product')
                ->schema([
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('supplier_id')
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->preload(),
                    TextInput::make('purchase_price')
                        ->required()
                        ->prefix('$')
                        ->numeric()
                        ->default(0),
                    TextInput::make('selling_price')
                        ->required()
                        ->prefix('$')
                        ->numeric()
                        ->default(0),
                ]),
            Step::make('Inventory')
                ->description('Set initial stock and other inventory details ')
                ->schema([
                    TextInput::make('current_stock')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('minimum_stock')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('unit')
                        ->required()
                        ->default('pcs'),
                    TextInput::make('barcode'),
                ]),
            Step::make('Media & Status')
                ->description('Upload product image and set status')
                ->schema([
                    //Assuming FileUpload is already imported
                    FileUpload::make('image')
                        ->image(),
                    Toggle::make('is_active')
                        ->required(),
                ]),
        ];
    }
}
