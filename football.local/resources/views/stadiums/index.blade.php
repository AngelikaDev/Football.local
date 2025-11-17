@extends('layouts.app')

@section('title', 'Стадионы - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Стадионы Премьер-лиги</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($stadiums as $stadium)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-stadium text-white text-6xl"></i>
            </div>
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $stadium->name }}</h2>
                <p class="text-gray-600 mb-4">
                    <i class="fas fa-city mr-2"></i>{{ $stadium->city }}
                </p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">
                        Матчей: {{ $stadium->matches_count }}
                    </span>
                    <a href="{{ route('stadiums.show', $stadium->id) }}" 
                       class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition text-sm">
                        Подробнее
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-stadium text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 text-xl">Стадионы пока не добавлены</p>
        </div>
        @endforelse
    </div>
</div>
@endsection