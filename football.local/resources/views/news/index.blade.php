@extends('layouts.app')

@section('title', 'Новости - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Новости Премьер-лиги</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($news as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" 
                 alt="{{ $item->title }}" 
                 class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-3 text-gray-800 line-clamp-2">{{ $item->title }}</h2>
                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">
                        <i class="far fa-calendar mr-1"></i>{{ $item->publish_date->format('d.m.Y') }}
                    </span>
                    <a href="{{ route('news.show', $item->id) }}" 
                       class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition text-sm">
                        Читать далее
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 text-xl">Новости пока не добавлены</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $news->links() }}
    </div>
</div>
@endsection