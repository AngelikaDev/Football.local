<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Matches;
use App\Models\Commands;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = News::where('is_published', true)
            ->orderBy('publish_date', 'desc')
            ->take(4)
            ->get();

        $upcomingMatches = Matches::with(['host', 'guest', 'stadiumInfo'])
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();

        $teams = Commands::with(['homeMatches', 'awayMatches'])->get();

        $standings = $teams->map(function($team) {
            $homeMatches = $team->homeMatches->where('date', '<', now());
            $awayMatches = $team->awayMatches->where('date', '<', now());
            $matches = $homeMatches->merge($awayMatches);
            
            $played = $matches->count();
            $wins = $matches->filter(function($match) use ($team) {
                if ($match->hosts_goals > $match->guests_goals && $match->hosts == $team->id) {
                    return true;
                }
                if ($match->guests_goals > $match->hosts_goals && $match->guests == $team->id) {
                    return true;
                }
                return false;
            })->count();
            
            $draws = $matches->filter(function($match) {
                return $match->hosts_goals == $match->guests_goals;
            })->count();
            
            $losses = $played - $wins - $draws;
            
            $goalsFor = $homeMatches->sum('hosts_goals') + $awayMatches->sum('guests_goals');
            $goalsAgainst = $homeMatches->sum('guests_goals') + $awayMatches->sum('hosts_goals');
            
            return [
                'team' => $team,
                'played' => $played,
                'wins' => $wins,
                'draws' => $draws,
                'losses' => $losses,
                'goals_for' => $goalsFor,
                'goals_against' => $goalsAgainst,
                'goal_difference' => $goalsFor - $goalsAgainst,
                'points' => ($wins * 3) + $draws,
            ];
        })->sortByDesc('points')->sortByDesc('goal_difference')->take(6);

        return view('home', compact('latestNews', 'upcomingMatches', 'standings'));
    }
}