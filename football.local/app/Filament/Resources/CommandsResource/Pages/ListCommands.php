<?php

namespace App\Filament\Resources\CommandsResource\Pages;

use App\Filament\Resources\CommandsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommands extends ListRecords
{
    protected static string $resource = CommandsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
