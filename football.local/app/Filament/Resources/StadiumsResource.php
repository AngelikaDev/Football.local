<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StadiumsResource\Pages;
use App\Models\Stadiums;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StadiumsResource extends Resource
{
    protected static ?string $model = Stadiums::class;

   protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Стадионы';
    protected static ?string $modelLabel = 'стадион';
    protected static ?string $pluralModelLabel = 'Стадионы';
    protected static ?string $navigationGroup = 'Футбольные данные';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название стадиона')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('city')
                    ->label('Город')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('city')
                    ->label('Город')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city')
                    ->label('Город')
                    ->searchable()
                    ->options(fn () => Stadiums::pluck('city', 'city')->unique()),
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
            'index' => Pages\ListStadiums::route('/'),
            'create' => Pages\CreateStadiums::route('/create'),
            'edit' => Pages\EditStadiums::route('/{record}/edit'),
        ];
    }
}