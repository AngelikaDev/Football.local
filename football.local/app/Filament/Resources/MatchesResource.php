<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchesResource\Pages;
use App\Models\Matches;
use App\Models\Commands;
use App\Models\Stadiums;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DateTimePicker;

class MatchesResource extends Resource
{
    protected static ?string $model = Matches::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Матчи';
    protected static ?string $modelLabel = 'матч';
    protected static ?string $pluralModelLabel = 'Матчи';
    protected static ?string $navigationGroup = 'Футбольные данные';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Команды участники')
                    ->schema([
                        Forms\Components\Select::make('hosts')
                            ->label('Хозяева')
                            ->options(Commands::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\Select::make('guests')
                            ->label('Гости')
                            ->options(Commands::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Детали матча')
                    ->schema([
                        Forms\Components\Select::make('stadium')
                            ->label('Стадион')
                            ->options(Stadiums::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        DateTimePicker::make('date')
                            ->label('Дата и время')
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Результат')
                    ->description('Заполните после окончания матча')
                    ->schema([
                        Forms\Components\TextInput::make('hosts_goals')
                            ->label('Голы хозяев')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(20)
                            ->default(0)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('guests_goals')
                            ->label('Голы гостей')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(20)
                            ->default(0)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('hosts')
                    ->label('Хозяева ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('guests')
                    ->label('Гости ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('host.name')
                    ->label('Хозяева')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->host) {
                            return 'Команда #' . $record->hosts;
                        }
                        return $record->host->name;
                    }),

                Tables\Columns\TextColumn::make('guest.name')
                    ->label('Гости')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->guest) {
                            return 'Команда #' . $record->guests;
                        }
                        return $record->guest->name;
                    }),

                Tables\Columns\TextColumn::make('stadium')
                    ->label('Стадион ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('stadiumInfo.name')
                    ->label('Стадион')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->stadiumInfo) {
                            return 'Стадион #' . $record->stadium;
                        }
                        return $record->stadiumInfo->name;
                    })
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('date')
                    ->label('Дата и время')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('result')
                    ->label('Результат')
                    ->getStateUsing(function ($record) {
                        if ($record->hosts_goals === null || $record->guests_goals === null) {
                            return 'Не сыгран';
                        }
                        return $record->hosts_goals . ' - ' . $record->guests_goals;
                    })
                    ->badge()
                    ->color(function ($record) {
                        if ($record->hosts_goals === null || $record->guests_goals === null) {
                            return 'gray';
                        }

                        if ($record->hosts_goals > $record->guests_goals) {
                            return 'success';
                        } elseif ($record->hosts_goals < $record->guests_goals) {
                            return 'danger';
                        } else {
                            return 'warning';
                        }
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->getStateUsing(fn($record) => $record->date < now() ? 'Завершен' : 'Предстоящий')
                    ->badge()
                    ->color(fn($state) => $state === 'Завершен' ? 'success' : 'info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('upcoming')
                    ->label('Предстоящие матчи')
                    ->query(fn($query) => $query->where('date', '>=', now())),

                Tables\Filters\Filter::make('past')
                    ->label('Прошедшие матчи')
                    ->query(fn($query) => $query->where('date', '<', now())),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMatches::route('/'),
            'create' => Pages\CreateMatches::route('/create'),
            'edit' => Pages\EditMatches::route('/{record}/edit'),
        ];
    }
}