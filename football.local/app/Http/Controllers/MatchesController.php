<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Goals;
use App\Models\RedCards;
use App\Models\YellowCards;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index()
    {
        $matches = Matches::with(['host', 'guest', 'stadiumInfo'])
            ->orderBy('date', 'desc')
            ->paginate(10);
            
        return view('matches.index', compact('matches'));
    }

    public function show($id)
    {
        $match = Matches::with(['host', 'guest', 'stadiumInfo'])->findOrFail($id);
        
        $goals = Goals::with('player')->where('match', $id)->get();
        $yellowCards = YellowCards::with('player')->where('match', $id)->get();
        $redCards = RedCards::with('player')->where('match', $id)->get();
        
        return view('matches.show', compact('match', 'goals', 'yellowCards', 'redCards'));
    }

    public function schedule()
    {
        $matches = Matches::with(['host', 'guest', 'stadiumInfo'])
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();
            
        return view('matches.schedule', compact('matches'));
    }

    public function results()
    {
        $matches = Matches::with(['host', 'guest', 'stadiumInfo'])
            ->where('date', '<', now())
            ->orderBy('date', 'desc')
            ->paginate(10);
            
        return view('matches.results', compact('matches'));
    }
}