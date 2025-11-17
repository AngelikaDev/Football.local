<?php

namespace App\Filament\Resources\StadiumsResource\Pages;

use App\Filament\Resources\StadiumsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ListStadiums extends ListRecords
{
    protected static string $resource = StadiumsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Добавить стадион')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('city')
                    ->label('Город')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
          
            ->actions([
                \Filament\Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil'),
                \Filament\Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
                \Filament\Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye'),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash'),
                ]),
            ]);
    }
}