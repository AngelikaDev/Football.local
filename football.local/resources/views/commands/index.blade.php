@extends('layouts.app')

@section('title', 'Команды - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Команды Премьер-лиги</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($commands as $command)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="p-6 text-center">
                <img src="{{ asset('storage/' . $command->image) }}" 
                     alt="{{ $command->name }}" 
                     class="w-20 h-20 mx-auto mb-4 rounded-full">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $command->name }}</h2>
                <p class="text-gray-600 mb-2">{{ $command->city }}</p>
                <p class="text-sm text-gray-500 mb-4">Стадион: {{ $command->stadium->name ?? 'Не указан' }}</p>
                <a href="{{ route('commands.show', $command->id) }}" 
                   class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                    Подробнее
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-users text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 text-xl">Команды пока не добавлены</p>
        </div>
        @endforelse
    </div>
</div>
@endsection