<?php

namespace App\Filament\Resources\YellowCardsResource\Pages;

use App\Filament\Resources\YellowCardsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYellowCards extends EditRecord
{
    protected static string $resource = YellowCardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
