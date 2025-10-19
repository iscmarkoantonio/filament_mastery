<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Imports\UserImporter;
use Filament\Actions\Action;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Action::make('Disable User')
    //             ->action('disableUser'),
    //     ];
    // }
}
