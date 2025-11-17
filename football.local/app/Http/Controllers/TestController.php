<?php

namespace App\Http\Controllers;

use App\Models\Goals;
use App\Models\YellowCards;
use App\Models\RedCards;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testGoals()
    {
        try {
            $goal = Goals::with(['matchInfo.host', 'matchInfo.guest', 'playerInfo'])->first();
            
            if (!$goal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Нет данных в таблице goals'
                ]);
            }
            
            $result = [
                'goal_data' => $goal->toArray(),
                'match_info' => $goal->matchInfo ? [
                    'id' => $goal->matchInfo->id,
                    'display' => $goal->matchInfo->display,
                    'host' => $goal->matchInfo->host ? $goal->matchInfo->host->name : null,
                    'guest' => $goal->matchInfo->guest ? $goal->matchInfo->guest->name : null,
                    'date' => $goal->matchInfo->date,
                ] : null,
                'player_info' => $goal->playerInfo ? [
                    'id' => $goal->playerInfo->id,
                    'name' => $goal->playerInfo->name,
                    'position' => $goal->playerInfo->position,
                ] : null
            ];
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function testGoalsModel()
    {
        try {
           
            $goal = new Goals();
            $fillable = $goal->getFillable();
            $table = $goal->getTable();
            
            return response()->json([
                'success' => true,
                'model_info' => [
                    'table' => $table,
                    'fillable' => $fillable,
                    'exists' => Goals::exists(),
                    'count' => Goals::count()
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function testYellowCards()
    {
        try {
            $card = \App\Models\YellowCards::with(['matchInfo.host', 'matchInfo.guest', 'playerInfo'])->first();
            
            if (!$card) {
                return response()->json([
                    'success' => false,
                    'message' => 'Нет данных в таблице yellow_cards'
                ]);
            }
            
            $result = [
                'card_data' => $card->toArray(),
                'match_info' => $card->matchInfo ? [
                    'id' => $card->matchInfo->id,
                    'display' => $card->matchInfo->display,
                    'host' => $card->matchInfo->host ? $card->matchInfo->host->name : null,
                    'guest' => $card->matchInfo->guest ? $card->matchInfo->guest->name : null,
                ] : null,
                'player_info' => $card->playerInfo ? [
                    'id' => $card->playerInfo->id,
                    'name' => $card->playerInfo->name,
                ] : null
            ];
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function testRedCards()
    {
        try {
            $card = \App\Models\RedCards::with(['matchInfo.host', 'matchInfo.guest', 'playerInfo'])->first();
            
            if (!$card) {
                return response()->json([
                    'success' => false,
                    'message' => 'Нет данных в таблице red_cards'
                ]);
            }
            
            $result = [
                'card_data' => $card->toArray(),
                'match_info' => $card->matchInfo ? [
                    'id' => $card->matchInfo->id,
                    'display' => $card->matchInfo->display,
                    'host' => $card->matchInfo->host ? $card->matchInfo->host->name : null,
                    'guest' => $card->matchInfo->guest ? $card->matchInfo->guest->name : null,
                ] : null,
                'player_info' => $card->playerInfo ? [
                    'id' => $card->playerInfo->id,
                    'name' => $card->playerInfo->name,
                ] : null
            ];
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
public function testMatches()
{
    try {
        $match = \App\Models\Matches::with(['host', 'guest', 'stadiumInfo'])->first();
        
        if (!$match) {
            return response()->json([
                'success' => false,
                'message' => 'Нет данных в таблице matches'
            ]);
        }
        
        $result = [
            'match_data' => $match->toArray(),
            'host_info' => $match->host ? [
                'id' => $match->host->id,
                'name' => $match->host->name,
            ] : null,
            'guest_info' => $match->guest ? [
                'id' => $match->guest->id,
                'name' => $match->guest->name,
            ] : null,
            'stadium_info' => $match->stadiumInfo ? [
                'id' => $match->stadiumInfo->id,
                'name' => $match->stadiumInfo->name,
            ] : null
        ];
        
        return response()->json([
            'success' => true,
            'data' => $result
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function testCardsModels()
    {
        try {
            $yellowCards = new \App\Models\YellowCards();
            $redCards = new \App\Models\RedCards();
            
            return response()->json([
                'success' => true,
                'models' => [
                    'yellow_cards' => [
                        'table' => $yellowCards->getTable(),
                        'fillable' => $yellowCards->getFillable(),
                        'exists' => \App\Models\YellowCards::exists(),
                        'count' => \App\Models\YellowCards::count()
                    ],
                    'red_cards' => [
                        'table' => $redCards->getTable(),
                        'fillable' => $redCards->getFillable(),
                        'exists' => \App\Models\RedCards::exists(),
                        'count' => \App\Models\RedCards::count()
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}