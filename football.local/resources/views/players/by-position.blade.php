@extends('layouts.app')

@section('title', $positionNames[$position] ?? $position . ' - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">{{ $positionNames[$position] ?? $position }}</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('players.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                Все игроки
            </a>
            <a href="{{ route('players.by-position', 'Вратарь') }}" 
               class="px-4 py-2 {{ $position == 'Вратарь' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800' }} rounded hover:bg-blue-200 transition">
                Вратари
            </a>
            <a href="{{ route('players.by-position', 'Защитник') }}" 
               class="px-4 py-2 {{ $position == 'Защитник' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-800' }} rounded hover:bg-green-200 transition">
                Защитники
            </a>
            <a href="{{ route('players.by-position', 'Полузащитник') }}" 
               class="px-4 py-2 {{ $position == 'Полузащитник' ? 'bg-yellow-600 text-white' : 'bg-yellow-100 text-yellow-800' }} rounded hover:bg-yellow-200 transition">
                Полузащитники
            </a>
            <a href="{{ route('players.by-position', 'Нападающий') }}" 
               class="px-4 py-2 {{ $position == 'Нападающий' ? 'bg-red-600 text-white' : 'bg-red-100 text-red-800' }} rounded hover:bg-red-200 transition">
                Нападающие
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($players as $player)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('storage/' . $player->photo) }}" 
                 alt="{{ $player->name }}" 
                 class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $player->name }}</h3>
                <p class="text-gray-600 mb-2">{{ $player->position }}</p>
                <p class="text-gray-500 text-sm mb-3">{{ $player->country }}</p>
                <a href="{{ route('players.show', $player->id) }}" 
                   class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition text-sm w-full block text-center">
                    Профиль
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-12">
            <i class="fas fa-users text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 text-xl">Игроки на позиции "{{ $position }}" не найдены</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $players->links() }}
    </div>
</div>
@endsection