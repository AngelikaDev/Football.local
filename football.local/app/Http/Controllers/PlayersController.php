<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Goals;
use App\Models\RedCards;
use App\Models\YellowCards;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    public function index()
    {
        $players = Players::orderBy('name')->paginate(20);
        return view('players.index', compact('players'));
    }

    public function show($id)
    {
        $player = Players::findOrFail($id);
        
        $goals = Goals::where('player', $id)
            ->with('matchInfo')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $yellowCards = YellowCards::where('player', $id)
            ->with('matchInfo')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $redCards = RedCards::where('player', $id)
            ->with('matchInfo')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalGoals = $goals->count();
        $totalYellowCards = $yellowCards->count();
        $totalRedCards = $redCards->count();

        return view('players.show', compact('player', 'goals', 'yellowCards', 'redCards', 'totalGoals', 'totalYellowCards', 'totalRedCards'));
    }

    public function byPosition($position)
    {
        $players = Players::where('position', $position)
            ->orderBy('name')
            ->paginate(20);
            
        $positionNames = [
            'Вратарь' => 'Вратари',
            'Защитник' => 'Защитники',
            'Полузащитник' => 'Полузащитники',
            'Нападающий' => 'Нападающие'
        ];
            
        return view('players.by-position', compact('players', 'position', 'positionNames'));
    }
}