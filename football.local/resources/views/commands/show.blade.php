@extends('layouts.app')

@section('title', $command->name . ' - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
            <img src="{{ asset('storage/' . $command->image) }}" 
                 alt="{{ $command->name }}" 
                 class="w-32 h-32 rounded-full">
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $command->name }}</h1>
                <p class="text-gray-600 mb-2"><i class="fas fa-city mr-2"></i>Город: {{ $command->city }}</p>
                <p class="text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-2"></i>Стадион: {{ $command->stadium->name ?? 'Не указан' }}</p>
                <p class="text-gray-600"><i class="fas fa-user-tie mr-2"></i>Тренер: {{ $command->coach->name ?? 'Не указан' }}</p>
            </div>
        </div>
    </div>

    @if($players->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Состав команды</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($players as $player)
            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/' . $player->photo) }}" 
                         alt="{{ $player->name }}" 
                         class="w-12 h-12 rounded-full">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $player->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $player->position }}</p>
                        <p class="text-xs text-gray-500">{{ $player->country }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Домашние матчи</h2>
            @forelse($command->homeMatches as $match)
            <div class="border-b py-3 last:border-b-0">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">{{ $match->guest->name }}</span>
                    <span class="text-gray-600">{{ $match->date->format('d.m.Y H:i') }}</span>
                </div>
                <div class="text-sm text-gray-500">Счёт: {{ $match->hosts_goals }}:{{ $match->guests_goals }}</div>
            </div>
            @empty
            <p class="text-gray-600">Нет домашних матчей</p>
            @endforelse
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Гостевые матчи</h2>
            @forelse($command->awayMatches as $match)
            <div class="border-b py-3 last:border-b-0">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">{{ $match->host->name }}</span>
                    <span class="text-gray-600">{{ $match->date->format('d.m.Y H:i') }}</span>
                </div>
                <div class="text-sm text-gray-500">Счёт: {{ $match->guests_goals }}:{{ $match->hosts_goals }}</div>
            </div>
            @empty
            <p class="text-gray-600">Нет гостевых матчей</p>
            @endforelse
        </div>
    </div>
</div>
@endsection