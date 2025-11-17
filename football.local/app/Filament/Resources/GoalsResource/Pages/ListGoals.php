<?php

namespace App\Filament\Resources\GoalsResource\Pages;

use App\Filament\Resources\GoalsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGoals extends ListRecords
{
    protected static string $resource = GoalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
