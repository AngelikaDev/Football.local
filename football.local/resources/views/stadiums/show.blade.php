@extends('layouts.app')

@section('title', $stadium->name . ' - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-6">
            <div class="w-32 h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                <i class="fas fa-stadium text-white text-4xl"></i>
            </div>
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $stadium->name }}</h1>
                <p class="text-gray-600 text-lg mb-4">
                    <i class="fas fa-city mr-2"></i>{{ $stadium->city }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        Матчей: {{ $upcomingMatches->count() + $pastMatches->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if($upcomingMatches->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Ближайшие матчи</h2>
        <div class="space-y-4">
            @foreach($upcomingMatches as $match)
            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <span class="font-semibold">{{ $match->host->name }}</span>
                        <span class="text-gray-500">vs</span>
                        <span class="font-semibold">{{ $match->guest->name }}</span>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">{{ $match->date->format('d.m.Y H:i') }}</div>
                        <div class="text-sm text-green-600 font-semibold">{{ $match->date->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($pastMatches->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Прошедшие матчи</h2>
        <div class="space-y-4">
            @foreach($pastMatches as $match)
            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <span class="font-semibold">{{ $match->host->name }}</span>
                        <span class="text-2xl font-bold mx-2">{{ $match->hosts_goals }}:{{ $match->guests_goals }}</span>
                        <span class="font-semibold">{{ $match->guest->name }}</span>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">{{ $match->date->format('d.m.Y') }}</div>
                        <a href="{{ route('matches.show', $match->id) }}" 
                           class="text-purple-600 hover:text-purple-800 text-sm font-semibold">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection