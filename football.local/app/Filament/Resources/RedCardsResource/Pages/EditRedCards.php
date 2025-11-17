<?php

namespace App\Filament\Resources\RedCardsResource\Pages;

use App\Filament\Resources\RedCardsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRedCards extends EditRecord
{
    protected static string $resource = RedCardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
