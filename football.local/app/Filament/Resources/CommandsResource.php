<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandsResource\Pages;
use App\Models\Commands;
use App\Models\Players;
use App\Models\Stadiums;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;

class CommandsResource extends Resource
{
    protected static ?string $model = Commands::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Команды';
    protected static ?string $modelLabel = 'команда';
    protected static ?string $pluralModelLabel = 'Команды';
    protected static ?string $navigationGroup = 'Футбольные данные';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название команды')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('city')
                            ->label('Город')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Руководство и стадион')
                    ->schema([
                        Forms\Components\Select::make('coach')
                            ->label('Главный тренер')
                            ->options(Players::where('position', 'Тренер')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('stadium')
                            ->label('Стадион')
                            ->options(Stadiums::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Медиа')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Герб команды')
                            ->disk('public')
                            ->directory('commands')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('150')
                            ->imageResizeMode('contain')
                            ->panelAspectRatio('2:1')
                            ->required()
                            ->helperText('Загрузите герб или логотип команды'),
                    ]),

                Section::make('Состав команды')
                    ->description('Добавьте игроков в состав команды')
                    ->schema([
                        Forms\Components\Repeater::make('composition')
                            ->label('Игроки состава')
                            ->schema([
                                Forms\Components\Select::make('player_id')
                                    ->label('Игрок')
                                    ->options(Players::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('number')
                                    ->label('Игровой номер')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(99)
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->itemLabel(
                                fn(array $state): ?string =>
                                $state['player_id'] ?? null
                                ? Players::find($state['player_id'])?->name . ' (' . ($state['number'] ?? 'без номера') . ')'
                                : 'Новый игрок'
                            )
                            ->addActionLabel('Добавить игрока')
                            ->defaultItems(0)
                            ->collapsible()
                            ->cloneable()
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Герб')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Город')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('coach')
                    ->label('Тренер ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stadium')
                    ->label('Стадион ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('composition_count')
                    ->label('Игроков в составе')
                    ->getStateUsing(function ($record) {
                        if (is_array($record->composition)) {
                            return count($record->composition);
                        }
                        if (is_string($record->composition)) {
                            $decoded = json_decode($record->composition, true);
                            return is_array($decoded) ? count($decoded) : 0;
                        }
                        return 0;
                    })
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color(fn($state) => $state > 0 ? 'success' : 'gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommands::route('/create'),
            'edit' => Pages\EditCommands::route('/{record}/edit'),
        ];
    }
}