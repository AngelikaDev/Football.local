<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoalsResource\Pages;
use App\Models\Goals;
use App\Models\Matches;
use App\Models\Players;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class GoalsResource extends Resource
{
    protected static ?string $model = Goals::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Голы';
    protected static ?string $modelLabel = 'гол';
    protected static ?string $pluralModelLabel = 'Голы';
    protected static ?string $navigationGroup = 'Статистика';


         public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        Forms\Components\Select::make('match')
                            ->label('Матч')
                            ->options(
                                Matches::with(['host', 'guest'])
                                    ->get()
                                    ->mapWithKeys(function ($match) {
                                        $host = $match->host ? $match->host->name : 'Команда #' . $match->hosts;
                                        $guest = $match->guest ? $match->guest->name : 'Команда #' . $match->guests;
                                        $date = $match->getFormattedDate();
                                        
                                        return [
                                            $match->id => $host . ' vs ' . $guest . ' (' . $date . ')'
                                        ];
                                    })
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),
                        
                        Forms\Components\Select::make('player')
                            ->label('Игрок')
                            ->options(Players::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Время гола')
                    ->schema([
                        Forms\Components\TextInput::make('minutes')
                            ->label('Минута')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(120)
                            ->required()
                            ->columnSpan(1)
                            ->suffix('минута'),
                        
                        Forms\Components\TextInput::make('seconds')
                            ->label('Секунды')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(59)
                            ->default(0)
                            ->columnSpan(1)
                            ->suffix('секунды'),
                    ])
                    ->columns(2)
                    ->description('Укажите время, когда был забит гол'),
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
                    
            
                Tables\Columns\TextColumn::make('matchInfo.display')
                    ->label('Матч')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->matchInfo) {
                            return 'Матч #' . $record->match;
                        }
                        
                        $host = $record->matchInfo->host ? $record->matchInfo->host->name : 'Команда #' . $record->matchInfo->hosts;
                        $guest = $record->matchInfo->guest ? $record->matchInfo->guest->name : 'Команда #' . $record->matchInfo->guests;
                        
                        return $host . ' vs ' . $guest;
                    }),
                
                Tables\Columns\TextColumn::make('playerInfo.name')
                    ->label('Игрок')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->playerInfo) {
                            return 'Игрок #' . $record->player;
                        }
                        return $record->playerInfo->name;
                    }),
                
                Tables\Columns\TextColumn::make('time')
                    ->label('Время')
                    ->getStateUsing(fn ($record) => $record->minutes . "'" . ($record->seconds > 0 ? ' ' . $record->seconds . '"' : ''))
                    ->sortable(['minutes', 'seconds']),
                
                Tables\Columns\TextColumn::make('matchInfo.date')
                    ->label('Дата матча')
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('playerInfo.position')
                    ->label('Позиция')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('player')
                    ->label('Игрок')
                    ->relationship('playerInfo', 'name')
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\SelectFilter::make('match')
                    ->label('Матч')
                    ->relationship('matchInfo', 'id')
                    ->searchable(),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoals::route('/'),
            'create' => Pages\CreateGoals::route('/create'),
            'edit' => Pages\EditGoals::route('/{record}/edit'),
        ];
    }
}


   
