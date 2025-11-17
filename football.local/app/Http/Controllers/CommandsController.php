<?php

namespace App\Http\Controllers;

use App\Models\Commands;
use App\Models\Players;
use App\Models\Matches;
use Illuminate\Http\Request;

class CommandsController extends Controller
{
    public function index()
    {
        $commands = Commands::with(['coach', 'stadium'])->get();
        return view('commands.index', compact('commands'));
    }

    public function show($id)
    {
        $command = Commands::with(['coach', 'stadium', 'homeMatches', 'awayMatches'])->findOrFail($id);
      
        $playerIds = [];
        if ($command->composition) {
            if (is_array($command->composition)) {
                $playerIds = $command->composition;
            } else {
                $playerIds = json_decode($command->composition, true) ?? [];
            }
        }
        
        $playerIds = collect($playerIds)->pluck('player_id')->filter()->toArray();
        $players = Players::whereIn('id', $playerIds)->get();
        
        return view('commands.show', compact('command', 'players'));
    }

    public function standings()
    {
        $teams = Commands::with(['homeMatches', 'awayMatches'])->get();

        $standings = $teams->map(function($team) {
            $homeMatches = $team->homeMatches->where('date', '<', now());
            $awayMatches = $team->awayMatches->where('date', '<', now());
            $matches = $homeMatches->merge($awayMatches);
            
            $played = $matches->count();
            $wins = $matches->filter(function($match) use ($team) {
                if ($match->hosts == $team->id && $match->hosts_goals > $match->guests_goals) {
                    return true;
                }
                if ($match->guests == $team->id && $match->guests_goals > $match->hosts_goals) {
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
        })->sortByDesc('points')->sortByDesc('goal_difference')->values();

        return view('commands.standings', compact('standings'));
    }
}