<?php

namespace App\Filament\Resources\PlayersResource\Pages;

use App\Filament\Resources\PlayersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlayers extends CreateRecord
{
    protected static string $resource = PlayersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Игрок успешно создан';
    }
}