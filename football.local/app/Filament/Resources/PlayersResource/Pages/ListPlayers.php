<?php

namespace App\Filament\Resources\PlayersResource\Pages;

use App\Filament\Resources\PlayersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ListPlayers extends ListRecords
{
    protected static string $resource = PlayersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Добавить игрока')
                ->icon('heroicon-o-user-plus'),
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
                
                ImageColumn::make('photo')
                    ->label('Фото')
                    ->disk('public')
                    ->circular()
                    ->sortable(),
                
                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('position')
                    ->label('Позиция')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Вратарь' => 'blue',
                        'Защитник' => 'green',
                        'Полузащитник' => 'yellow',
                        'Нападающий' => 'red',
                        'Тренер' => 'gray',
                        default => 'gray',
                    }),
                
                TextColumn::make('country')
                    ->label('Страна')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('birth_date')
                    ->label('Дата рождения')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('goals_count')
                    ->label('Голы')
                    ->counts('goals')
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('career_count')
                    ->label('Клубов')
                    ->getStateUsing(fn ($record) => $record->career ? count($record->career) : 0)
                    ->sortable()
                    ->alignCenter(),
                
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