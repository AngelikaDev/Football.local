<?php

namespace App\Filament\Resources\CommandsResource\Pages;

use App\Filament\Resources\CommandsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommands extends EditRecord
{
    protected static string $resource = CommandsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
