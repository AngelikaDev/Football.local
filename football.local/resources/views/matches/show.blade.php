@extends('layouts.app')

@section('title', $match->host->name . ' vs ' . $match->guest->name . ' - Матч')

@section('content')
<div class="max-w-4xl mx-auto">
 
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 card-hover">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $match->host->name ?? 'TBD' }} vs {{ $match->guest->name ?? 'TBD' }}</h1>
            <div class="text-lg text-gray-600">
                <i class="far fa-calendar mr-2"></i>{{ $match->getFormattedDate() }}
                <i class="far fa-clock ml-4 mr-2"></i>{{ $match->getFormattedTime() }}
            </div>
            <div class="text-gray-600 mt-2">
                <i class="fas fa-map-marker-alt mr-2"></i>
                {{ $match->stadiumInfo->name ?? 'Стадион не указан' }}, {{ $match->stadiumInfo->city ?? '' }}
            </div>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div class="text-center flex-1">
                @if($match->host->image && Storage::disk('public')->exists($match->host->image))
                <img src="{{ Storage::url($match->host->image) }}" alt="{{ $match->host->name }}" class="h-20 mx-auto mb-4">
                @else
                <div class="h-20 w-20 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                </div>
                @endif
                <h3 class="text-xl font-semibold text-gray-800">{{ $match->host->name ?? 'TBD' }}</h3>
                <p class="text-gray-600">{{ $match->host->city ?? '' }}</p>
            </div>

            <div class="mx-8">
                @if($match->hosts_goals !== null && $match->guests_goals !== null)
                <div class="text-4xl font-bold text-gray-800 bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-3 rounded-lg">
                    {{ $match->hosts_goals }} - {{ $match->guests_goals }}
                </div>
                <div class="text-center text-gray-600 mt-2">Финальный счёт</div>
                @else
                <div class="text-2xl font-bold text-gray-500 bg-gray-200 px-6 py-3 rounded-lg">
                    VS
                </div>
                <div class="text-center text-gray-600 mt-2">Матч не сыгран</div>
                @endif
            </div>

            <div class="text-center flex-1">
                @if($match->guest->image && Storage::disk('public')->exists($match->guest->image))
                <img src="{{ Storage::url($match->guest->image) }}" alt="{{ $match->guest->name }}" class="h-20 mx-auto mb-4">
                @else
                <div class="h-20 w-20 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                </div>
                @endif
                <h3 class="text-xl font-semibold text-gray-800">{{ $match->guest->name ?? 'TBD' }}</h3>
                <p class="text-gray-600">{{ $match->guest->city ?? '' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
  
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-futbol text-green-500 mr-2"></i> Голы
            </h3>
            @forelse($goals as $goal)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                <div class="flex items-center">
                    @if($goal->playerInfo && $goal->playerInfo->photo && Storage::disk('public')->exists($goal->playerInfo->photo))
                    <img src="{{ Storage::url($goal->playerInfo->photo) }}" alt="{{ $goal->playerInfo->name }}" class="h-8 w-8 rounded-full mr-3">
                    @else
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-400 text-sm"></i>
                    </div>
                    @endif
                    <span class="font-medium text-gray-800">{{ $goal->playerInfo->name ?? 'Неизвестный игрок' }}</span>
                </div>
                <span class="text-gray-600 font-semibold">{{ $goal->minutes }}'</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Голов не было</p>
            @endforelse
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i> Желтые карточки
            </h3>
            @forelse($yellowCards as $card)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                <div class="flex items-center">
                    @if($card->playerInfo && $card->playerInfo->photo && Storage::disk('public')->exists($card->playerInfo->photo))
                    <img src="{{ Storage::url($card->playerInfo->photo) }}" alt="{{ $card->playerInfo->name }}" class="h-8 w-8 rounded-full mr-3">
                    @else
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-400 text-sm"></i>
                    </div>
                    @endif
                    <span class="font-medium text-gray-800">{{ $card->playerInfo->name ?? 'Неизвестный игрок' }}</span>
                </div>
                <span class="text-gray-600 font-semibold">{{ $card->minutes }}'</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Желтых карточек не было</p>
            @endforelse
        </div>

    
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-times-circle text-red-500 mr-2"></i> Красные карточки
            </h3>
            @forelse($redCards as $card)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                <div class="flex items-center">
                    @if($card->playerInfo && $card->playerInfo->photo && Storage::disk('public')->exists($card->playerInfo->photo))
                    <img src="{{ Storage::url($card->playerInfo->photo) }}" alt="{{ $card->playerInfo->name }}" class="h-8 w-8 rounded-full mr-3">
                    @else
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-gray-400 text-sm"></i>
                    </div>
                    @endif
                    <span class="font-medium text-gray-800">{{ $card->playerInfo->name ?? 'Неизвестный игрок' }}</span>
                </div>
                <span class="text-gray-600 font-semibold">{{ $card->minutes }}'</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Красных карточек не было</p>
            @endforelse
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('matches.index') }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-green-600 transition transform hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i> Назад к матчам
        </a>
    </div>
</div>
@endsection