<?php

namespace App\Http\Controllers;

use App\Models\Goals;
use App\Models\RedCards;
use App\Models\YellowCards;
use App\Models\Players;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        try {
            $topScorers = Players::whereHas('goals')
                ->withCount('goals')
                ->orderBy('goals_count', 'desc')
                ->take(10)
                ->get();

            $yellowCards = Players::whereHas('yellowCards')
                ->withCount('yellowCards')
                ->orderBy('yellow_cards_count', 'desc')
                ->take(10)
                ->get();

            $redCards = Players::whereHas('redCards')
                ->withCount('redCards')
                ->orderBy('red_cards_count', 'desc')
                ->take(10)
                ->get();

            return view('statistics.index', compact('topScorers', 'yellowCards', 'redCards'));
            
        } catch (\Exception $e) {
            
            return view('statistics.index', [
                'topScorers' => collect(),
                'yellowCards' => collect(),
                'redCards' => collect()
            ]);
        }
    }

    public function topScorers()
    {
        try {
            $scorers = Players::whereHas('goals')
                ->withCount('goals')
                ->orderBy('goals_count', 'desc')
                ->get();
                
            return view('statistics.scorers', compact('scorers'));
        } catch (\Exception $e) {
            return view('statistics.scorers', ['scorers' => collect()]);
        }
    }

    public function cards()
    {
        try {
            $yellowCards = Players::whereHas('yellowCards')
                ->withCount('yellowCards')
                ->orderBy('yellow_cards_count', 'desc')
                ->get();

            $redCards = Players::whereHas('redCards')
                ->withCount('redCards')
                ->orderBy('red_cards_count', 'desc')
                ->get();

            return view('statistics.cards', compact('yellowCards', 'redCards'));
        } catch (\Exception $e) {
            return view('statistics.cards', [
                'yellowCards' => collect(),
                'redCards' => collect()
            ]);
        }
    }
}