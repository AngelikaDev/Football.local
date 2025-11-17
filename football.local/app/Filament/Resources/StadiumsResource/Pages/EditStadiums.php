<?php

namespace App\Filament\Resources\StadiumsResource\Pages;

use App\Filament\Resources\StadiumsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStadiums extends EditRecord
{
    protected static string $resource = StadiumsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Стадион успешно обновлен';
    }
}