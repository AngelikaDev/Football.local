@extends('layouts.app')

@section('title', $player->name . ' - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-6">
            <img src="{{ asset('storage/' . $player->photo) }}" 
                 alt="{{ $player->name }}" 
                 class="w-48 h-48 rounded-full object-cover">
            <div class="text-center md:text-left flex-1">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $player->name }}</h1>
                <div class="flex flex-wrap gap-4 mb-4 justify-center md:justify-start">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $player->position }}
                    </span>
                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-flag mr-1"></i>{{ $player->country }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $totalGoals }}</div>
                        <div class="text-sm text-gray-600">Голы</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $totalYellowCards }}</div>
                        <div class="text-sm text-gray-600">Жёлтые карточки</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">{{ $totalRedCards }}</div>
                        <div class="text-sm text-gray-600">Красные карточки</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $goals->count() + $yellowCards->count() + $redCards->count() }}</div>
                        <div class="text-sm text-gray-600">Всего событий</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($goals->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Забитые голы</h2>
        <div class="space-y-3">
            @foreach($goals as $goal)
            <div class="flex justify-between items-center py-2 border-b">
                <div>
                    <span class="font-semibold text-gray-800">Матч #{{ $goal->match }}</span>
                    <span class="text-sm text-gray-500 ml-3">{{ $goal->minutes }}'{{ $goal->seconds > 0 ? $goal->seconds . '"' : '' }}</span>
                </div>
                <span class="text-sm text-gray-500">{{ $goal->created_at->format('d.m.Y') }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($yellowCards->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Жёлтые карточки</h2>
        <div class="space-y-3">
            @foreach($yellowCards as $card)
            <div class="flex justify-between items-center py-2 border-b">
                <div>
                    <span class="font-semibold text-gray-800">Матч #{{ $card->match }}</span>
                    <span class="text-sm text-gray-500 ml-3">{{ $card->minutes }}'{{ $card->seconds > 0 ? $card->seconds . '"' : '' }}</span>
                </div>
                <span class="text-sm text-gray-500">{{ $card->created_at->format('d.m.Y') }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($redCards->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Красные карточки</h2>
        <div class="space-y-3">
            @foreach($redCards as $card)
            <div class="flex justify-between items-center py-2 border-b">
                <div>
                    <span class="font-semibold text-gray-800">Матч #{{ $card->match }}</span>
                    <span class="text-sm text-gray-500 ml-3">{{ $card->minutes }}'{{ $card->seconds > 0 ? $card->seconds . '"' : '' }}</span>
                </div>
                <span class="text-sm text-gray-500">{{ $card->created_at->format('d.m.Y') }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection