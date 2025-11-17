<?php

namespace App\Filament\Resources\YellowCardsResource\Pages;

use App\Filament\Resources\YellowCardsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYellowCards extends ListRecords
{
    protected static string $resource = YellowCardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
