<?php

namespace App\Filament\Resources\StadiumsResource\Pages;

use App\Filament\Resources\StadiumsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;

class CreateStadiums extends CreateRecord
{
    protected static string $resource = StadiumsResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Название стадиона')
                ->required()
                ->maxLength(255),
            
            TextInput::make('city')
                ->label('Город')
                ->required()
                ->maxLength(255),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Стадион успешно создан';
    }
}