<?php

namespace App\Http\Controllers;

use App\Models\Stadiums;
use App\Models\Matches;
use Illuminate\Http\Request;

class StadiumsController extends Controller
{
    public function index()
    {
        $stadiums = Stadiums::withCount('matches')->orderBy('name')->get();
        return view('stadiums.index', compact('stadiums'));
    }

    public function show($id)
    {
        $stadium = Stadiums::findOrFail($id);
        
        $upcomingMatches = Matches::whereHas('stadiumInfo', function($query) use ($id) {
            $query->where('id', $id);
        })
        ->where('date', '>=', now())
        ->with(['host', 'guest'])
        ->orderBy('date', 'asc')
        ->get();
            
        $pastMatches = Matches::whereHas('stadiumInfo', function($query) use ($id) {
            $query->where('id', $id);
        })
        ->where('date', '<', now())
        ->with(['host', 'guest'])
        ->orderBy('date', 'desc')
        ->take(10)
        ->get();

        return view('stadiums.show', compact('stadium', 'upcomingMatches', 'pastMatches'));
    }
}