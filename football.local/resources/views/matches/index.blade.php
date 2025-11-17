@extends('layouts.app')

@section('title', 'Все матчи - Футбольная Лига')

@section('content')
<div class="max-w-6xl mx-auto">
   
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 flex items-center justify-center">
            <i class="fas fa-tv text-purple-500 mr-3"></i>
            Все матчи
        </h1>
        <p class="text-lg text-gray-600">Полная история матчей сезона</p>
    </div>

    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg shadow-md p-1 flex space-x-1">
            <a href="{{ route('schedule') }}" class="px-4 py-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                <i class="fas fa-clock mr-2"></i>Расписание
            </a>
            <a href="{{ route('results') }}" class="px-4 py-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                <i class="fas fa-list-ol mr-2"></i>Результаты
            </a>
            <a href="{{ route('matches.index') }}" class="px-4 py-2 rounded-md bg-gradient-to-r from-blue-500 to-green-500 text-white transition">
                <i class="fas fa-tv mr-2"></i>Все матчи
            </a>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($matches as $match)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
            <div class="p-6">
               
                <div class="text-center mb-4">
                    <div class="text-lg font-semibold text-gray-800">
                        <i class="far fa-calendar mr-2 text-blue-500"></i>
                        {{ $match->getFormattedDate() }}
                    </div>
                    <div class="text-gray-600">
                        <i class="far fa-clock mr-2 text-green-500"></i>
                        {{ $match->getFormattedTime() }}
                    </div>
                    <div class="mt-1">
                        @if($match->date < now())
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Завершен
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-clock mr-1"></i> Предстоящий
                        </span>
                        @endif
                    </div>
                </div>

                
                <div class="flex flex-col md:flex-row items-center justify-between">
                  
                    <div class="text-center md:text-left mb-4 md:mb-0 md:w-1/3">
                        <div class="font-semibold text-lg text-gray-800">{{ $match->host->name ?? 'TBD' }}</div>
                        @if($match->host->image && Storage::disk('public')->exists($match->host->image))
                        <img src="{{ Storage::url($match->host->image) }}" alt="{{ $match->host->name }}" class="w-16 h-16 mx-auto md:mx-0 mt-2">
                        @else
                        <div class="w-16 h-16 mx-auto md:mx-0 mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-gray-400"></i>
                        </div>
                        @endif
                    </div>

                    <div class="text-center mx-4 mb-4 md:mb-0">
                        @if($match->date < now() && $match->hosts_goals !== null && $match->guests_goals !== null)
                        <div class="text-3xl font-bold bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-3 rounded-lg">
                            {{ $match->hosts_goals }} - {{ $match->guests_goals }}
                        </div>
                        <div class="text-sm text-gray-500 mt-2">Финальный счёт</div>
                        @else
                        <div class="text-2xl font-bold text-gray-500 bg-gray-100 px-4 py-2 rounded-lg">
                            VS
                        </div>
                        <div class="text-sm text-gray-500 mt-2">Матч не сыгран</div>
                        @endif
                    </div>

                    
                    <div class="text-center md:text-right md:w-1/3">
                        <div class="font-semibold text-lg text-gray-800">{{ $match->guest->name ?? 'TBD' }}</div>
                        @if($match->guest->image && Storage::disk('public')->exists($match->guest->image))
                        <img src="{{ Storage::url($match->guest->image) }}" alt="{{ $match->guest->name }}" class="w-16 h-16 mx-auto md:mx-0 mt-2">
                        @else
                        <div class="w-16 h-16 mx-auto md:mx-0 mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4 pt-4 border-t border-gray-100">
                    <div class="text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                        {{ $match->stadiumInfo->name ?? 'Стадион не указан' }}, {{ $match->stadiumInfo->city ?? '' }}
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('matches.show', $match->id) }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:from-blue-600 hover:to-green-600 transition transform hover:scale-105">
                        <i class="fas fa-info-circle mr-2"></i> Детали матча
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Матчей не найдено</h3>
            <p class="text-gray-600">Информация о матчах будет добавлена позже.</p>
        </div>
        @endforelse
    </div>

    @if($matches->hasPages())
    <div class="mt-8">
        {{ $matches->links() }}
    </div>
    @endif
</div>
@endsection