@extends('layouts.app')

@section('title', 'Карточки - Статистика - Футбольная Лига')

@section('content')
<div class="max-w-6xl mx-auto">
   
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center justify-center">
            <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
            Статистика карточек
        </h1>
        <p class="text-lg text-gray-600">Обзор желтых и красных карточек сезона</p>
    </div>

    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg shadow-md p-1 flex space-x-1">
            <a href="{{ route('statistics.index') }}" class="px-4 py-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                <i class="fas fa-chart-bar mr-2"></i>Общая
            </a>
            <a href="{{ route('statistics.scorers') }}" class="px-4 py-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                <i class="fas fa-futbol mr-2"></i>Бомбардиры
            </a>
            <a href="{{ route('statistics.cards') }}" class="px-4 py-2 rounded-md bg-gradient-to-r from-blue-500 to-green-500 text-white transition">
                <i class="fas fa-exclamation-triangle mr-2"></i>Карточки
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
            <div class="gradient-bg px-6 py-4">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-300 mr-3"></i>Топ по желтым карточкам
                </h2>
            </div>
            <div class="p-6">
                @forelse($yellowCards as $index => $player)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <span class="text-lg font-bold text-gray-700 w-8">{{ $index + 1 }}</span>
                        @if($player->photo && Storage::disk('public')->exists($player->photo))
                        <img src="{{ Storage::url($player->photo) }}" alt="{{ $player->name }}" class="h-10 w-10 rounded-full mx-3">
                        @else
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mx-3">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        @endif
                        <div>
                            <div class="font-semibold text-gray-800">{{ $player->name }}</div>
                            <div class="text-sm text-gray-500">{{ $player->position }} • {{ $player->country }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-bold text-yellow-600">{{ $player->yellow_cards_count }}</div>
                        <div class="text-sm text-gray-500">карточек</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Данные недоступны</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
            <div class="gradient-bg px-6 py-4">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-times-circle text-red-300 mr-3"></i>Топ по красным карточкам
                </h2>
            </div>
            <div class="p-6">
                @forelse($redCards as $index => $player)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <span class="text-lg font-bold text-gray-700 w-8">{{ $index + 1 }}</span>
                        @if($player->photo && Storage::disk('public')->exists($player->photo))
                        <img src="{{ Storage::url($player->photo) }}" alt="{{ $player->name }}" class="h-10 w-10 rounded-full mx-3">
                        @else
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mx-3">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        @endif
                        <div>
                            <div class="font-semibold text-gray-800">{{ $player->name }}</div>
                            <div class="text-sm text-gray-500">{{ $player->position }} • {{ $player->country }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xl font-bold text-red-600">{{ $player->red_cards_count }}</div>
                        <div class="text-sm text-gray-500">карточек</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-times-circle text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Данные недоступны</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('statistics.index') }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-green-600 transition transform hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i> Назад к статистике
        </a>
    </div>
</div>
@endsection