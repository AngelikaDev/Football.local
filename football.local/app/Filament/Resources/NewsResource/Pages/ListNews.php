<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class ListNews extends ListRecords
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Добавить новость')
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
                
                ImageColumn::make('image')
                    ->label('Изображение')
                    ->disk('public')
                    ->circular()
                    ->sortable(),
                
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                TextColumn::make('category')
                    ->label('Категория')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'matches' => 'blue',
                        'transfers' => 'green',
                        'injuries' => 'red',
                        'interviews' => 'yellow',
                        'other' => 'gray',
                        default => 'gray',
                    }),
                
                TextColumn::make('author')
                    ->label('Автор')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('publish_date')
                    ->label('Дата публикации')
                    ->date()
                    ->sortable(),
                
                IconColumn::make('is_published')
                    ->label('Опубликовано')
                    ->boolean()
                    ->sortable(),
                
                TextColumn::make('gallery_count')
                    ->label('Изображений')
                    ->getStateUsing(fn ($record) => $record->gallery ? count($record->gallery) : 0)
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('tags_count')
                    ->label('Тегов')
                    ->getStateUsing(fn ($record) => $record->tags ? count($record->tags) : 0)
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('created_at')
                    ->label('Создана')
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