<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Новости';
    protected static ?string $modelLabel = 'новость';
    protected static ?string $pluralModelLabel = 'Новости';
    protected static ?string $navigationGroup = 'Контент';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок новости')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Текст новости')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('news/images')
                            ->columnSpanFull(),
                    ]),

                Section::make('Медиа')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Главное изображение')
                            ->disk('public')
                            ->directory('news')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('200')
                            ->imageResizeMode('cover')
                            ->panelAspectRatio('2:1')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Загрузите главное изображение для новости'),

                        Forms\Components\Repeater::make('gallery')
                            ->label('Галерея изображений')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Изображение')
                                    ->disk('public')
                                    ->directory('news/gallery')
                                    ->image()
                                    ->imageEditor()
                                    ->imagePreviewHeight('150')
                                    ->required()
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('caption')
                                    ->label('Подпись')
                                    ->maxLength(255)
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('alt')
                                    ->label('Alt текст')
                                    ->maxLength(255)
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->addActionLabel('Добавить изображение')
                            ->defaultItems(0)
                            ->collapsible()
                            ->grid(2)

                    ]),

                Section::make('Публикация')
                    ->schema([
                        Forms\Components\DatePicker::make('publish_date')
                            ->label('Дата публикации')
                            ->required()
                            ->default(now()),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Опубликовано')
                            ->default(true)
                            ->required(),

                        Forms\Components\Select::make('category')
                            ->label('Категория')
                            ->options([
                                'matches' => 'Матчи',
                                'transfers' => 'Трансферы',
                                'injuries' => 'Травмы',
                                'interviews' => 'Интервью',
                                'other' => 'Другое',
                            ])
                            ->default('matches'),

                        Forms\Components\TextInput::make('author')
                            ->label('Автор')
                            ->maxLength(255)
                            ->default('Администратор'),

                    ])
                    ->columns(2),

                Section::make('Теги и метаданные')
                    ->schema([
                        Forms\Components\Repeater::make('tags')
                            ->label('Теги')
                            ->schema([
                                Forms\Components\TextInput::make('tag')
                                    ->label('Тег')
                                    ->required()
                                    ->maxLength(50),
                            ])
                            ->addActionLabel('Добавить тег')
                            ->defaultItems(0)
                            ->collapsible()
                            ->grid(2),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Мета-описание')
                            ->maxLength(160)
                            ->helperText('Краткое описание для SEO (до 160 символов)')
                            ->columnSpanFull(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение')
                    ->disk('public')
                    ->circular()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50),


                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'matches' => 'blue',
                        'transfers' => 'green',
                        'injuries' => 'red',
                        'interviews' => 'yellow',
                        'other' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('author')
                    ->label('Автор')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\TextColumn::make('publish_date')
                    ->label('Дата публикации')
                    ->date()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликовано')
                    ->boolean()
                    ->sortable(),


                Tables\Columns\TextColumn::make('gallery_count')
                    ->label('Изображений')
                    ->getStateUsing(fn($record) => $record->gallery ? count($record->gallery) : 0)
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('tags_count')
                    ->label('Тегов')
                    ->getStateUsing(fn($record) => $record->tags ? count($record->tags) : 0)
                    ->sortable()
                    ->alignCenter(),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->label('Опубликованные')
                    ->query(fn($query) => $query->where('is_published', true)),

                Tables\Filters\Filter::make('unpublished')
                    ->label('Неопубликованные')
                    ->query(fn($query) => $query->where('is_published', false)),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}