@extends('layouts.app')

@section('title', $news->title . ' - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" 
             alt="{{ $news->title }}" 
             class="w-full h-64 md:h-96 object-cover">
        @endif
        
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm text-gray-500">
                    <i class="far fa-calendar mr-1"></i>{{ $news->publish_date->format('d.m.Y') }}
                </span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    Опубликовано
                </span>
            </div>
            
            <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ $news->title }}</h1>
            
            <div class="prose max-w-none text-gray-700">
                {!! $news->content !!}
            </div>
        </div>
    </article>

    @if($latestNews->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Последние новости</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestNews as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" 
                     alt="{{ $item->title }}" 
                     class="w-full h-40 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-semibold mb-2 text-gray-800 line-clamp-2">{{ $item->title }}</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $item->publish_date->format('d.m.Y') }}</span>
                        <a href="{{ route('news.show', $item->id) }}" 
                           class="text-purple-600 hover:text-purple-800 text-sm font-semibold">
                            Читать →
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