<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayersResource\Pages;
use App\Models\Players;
use App\Models\Commands;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class PlayersResource extends Resource
{
    protected static ?string $model = Players::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Игроки';
    protected static ?string $modelLabel = 'игрок';
    protected static ?string $pluralModelLabel = 'Игроки';
    protected static ?string $navigationGroup = 'Футбольные данные';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('ФИО игрока')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('position')
                            ->label('Позиция')
                            ->options([
                                'Вратарь' => 'Вратарь',
                                'Защитник' => 'Защитник',
                                'Полузащитник' => 'Полузащитник',
                                'Нападающий' => 'Нападающий',
                                'Тренер' => 'Тренер',
                            ])
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('country')
                            ->label('Страна')
                            ->required()
                            ->maxLength(255),


                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Дата рождения')
                            ->maxDate(now()),

                        Forms\Components\TextInput::make('height')
                            ->label('Рост (см)')
                            ->numeric()
                            ->minValue(150)
                            ->maxValue(220),

                        Forms\Components\TextInput::make('weight')
                            ->label('Вес (кг)')
                            ->numeric()
                            ->minValue(50)
                            ->maxValue(120),

                    ])
                    ->columns(3),

                Section::make('Фотография')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Фото игрока')
                            ->disk('public')
                            ->directory('players')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('250')
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('2:1')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Загрузите фото игрока в формате JPG, PNG или WEBP'),
                    ]),


                Section::make('Карьера игрока')
                    ->schema([
                        Forms\Components\Repeater::make('career')
                            ->label('Клубная карьера')
                            ->schema([
                                Forms\Components\Select::make('team_id')
                                    ->label('Команда')
                                    ->options(Commands::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),

                                Forms\Components\TextInput::make('number')
                                    ->label('Игровой номер')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(99),

                                Forms\Components\DatePicker::make('start_date')
                                    ->label('Начало')
                                    ->required(),

                                Forms\Components\DatePicker::make('end_date')
                                    ->label('Конец')
                                    ->nullable(),

                                Forms\Components\TextInput::make('apps')
                                    ->label('Матчи')
                                    ->numeric()
                                    ->minValue(0),

                                Forms\Components\TextInput::make('goals')
                                    ->label('Голы')
                                    ->numeric()
                                    ->minValue(0),
                            ])
                            ->columns(6)
                            ->addActionLabel('Добавить клуб')
                            ->defaultItems(0)
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(
                                fn(array $state): ?string =>
                                $state['team_id'] ?? null
                                ? Commands::find($state['team_id'])?->name . ' (' . ($state['number'] ?? 'без номера') . ')'
                                : 'Новый клуб'
                            )
                    ]),

                Section::make('Достижения')
                    ->schema([
                        Forms\Components\Repeater::make('achievements')
                            ->label('Достижения и награды')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Название награды')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Select::make('type')
                                    ->label('Тип награды')
                                    ->options([
                                        'personal' => 'Личная',
                                        'team' => 'Командная',
                                        'international' => 'Международная',
                                    ])
                                    ->required(),

                                Forms\Components\TextInput::make('season')
                                    ->label('Сезон')
                                    ->maxLength(20),

                                Forms\Components\Textarea::make('description')
                                    ->label('Описание')
                                    ->maxLength(500)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3)
                            ->addActionLabel('Добавить достижение')
                            ->defaultItems(0)
                            ->collapsible()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Фото')
                    ->disk('public')
                    ->circular()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Позиция')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Вратарь' => 'blue',
                        'Защитник' => 'green',
                        'Полузащитник' => 'yellow',
                        'Нападающий' => 'red',
                        'Тренер' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('country')
                    ->label('Страна')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Дата рождения')
                    ->date()
                    ->sortable(),


                Tables\Columns\TextColumn::make('goals_count')
                    ->label('Голы')
                    ->counts('goals')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('career_count')
                    ->label('Клубов')
                    ->getStateUsing(fn($record) => $record->career ? count($record->career) : 0)
                    ->sortable()
                    ->alignCenter(),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Позиция')
                    ->options([
                        'Вратарь' => 'Вратарь',
                        'Защитник' => 'Защитник',
                        'Полузащитник' => 'Полузащитник',
                        'Нападающий' => 'Нападающий',
                        'Тренер' => 'Тренер',
                    ]),

                Tables\Filters\SelectFilter::make('country')
                    ->label('Страна')
                    ->searchable()
                    ->options(fn() => Players::pluck('country', 'country')->unique()),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayers::route('/create'),
            'edit' => Pages\EditPlayers::route('/{record}/edit'),
        ];
    }
}