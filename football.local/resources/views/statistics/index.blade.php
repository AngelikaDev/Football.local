@extends('layouts.app')

@section('title', 'Статистика - Английская Премьер-лига')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Статистика Премьер-лиги</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('statistics.scorers') }}"
                class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                <div class="text-center">
                    <i class="fas fa-futbol text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Бомбардиры</h2>
                    <p class="text-green-100">Топ 10 лучших снайперов</p>
                </div>
            </a>

            <a href="{{ route('statistics.cards') }}"
                class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Карточки</h2>
                    <p class="text-yellow-100">Статистика нарушений</p>
                </div>
            </a>

            <a href="{{ route('standings') }}"
                class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white hover:shadow-lg transition">
                <div class="text-center">
                    <i class="fas fa-trophy text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Турнирная таблица</h2>
                    <p class="text-purple-100">Положение команд</p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
         
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                    <i class="fas fa-futbol text-green-500 mr-3"></i>
                    Топ 10 бомбардиров
                </h2>
                <div class="space-y-4">
                    @forelse($topScorers as $index => $scorer)

                        <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="flex items-center space-x-3">
                                <span
                                    class="w-8 h-8 bg-green-100 text-green-800 rounded-full flex items-center justify-center font-semibold">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <span class="font-semibold text-gray-800">{{ $scorer->name ?? 'Неизвестный игрок' }}</span>
                                    <p class="text-sm text-gray-500">{{ $scorer->position ?? '' }} •
                                        {{ $scorer->country ?? '' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-green-600">{{ $scorer->goals_count ?? 0 }}</span>
                                <p class="text-sm text-gray-500">голов</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Нет данных о бомбардирах</p>
                    @endforelse
                </div>
                <div class="mt-6 text-center">
                    <a href="{{ route('statistics.scorers') }}" class="text-green-600 hover:text-green-800 font-semibold">
                        Вся статистика бомбардиров →
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                    Статистика карточек
                </h2>

                @forelse($yellowCards as $index => $card)
                    <div class="flex items-center justify-between p-2 border rounded">
                        <div class="flex items-center space-x-2">
                            <span
                                class="w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center text-xs font-semibold">
                                {{ $index + 1 }}
                            </span>
                            <span class="font-medium text-gray-700">{{ $card->player->name ?? 'Неизвестный игрок' }}</span>
                        </div>
                        <span class="font-bold text-yellow-600">{{ $card->cards_count }}</span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Нет данных</p>
                @endforelse

                <div>
                    <h3 class="text-lg font-semibold mb-3 text-gray-700 flex items-center">
                        <i class="fas fa-square text-red-500 mr-2"></i>
                        Красные карточки
                    </h3>
                    <div class="space-y-3">
                        @forelse($redCards as $index => $card)
                            <div class="flex items-center justify-between p-2 border rounded">
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="w-6 h-6 bg-red-100 text-red-800 rounded-full flex items-center justify-center text-xs font-semibold">
                                        {{ $index + 1 }}
                                    </span>
                                    <span
                                        class="font-medium text-gray-700">{{ $card->player->name ?? 'Неизвестный игрок' }}</span>
                                </div>
                                <span class="font-bold text-red-600">{{ $card->cards_count }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Нет данных</p>
                        @endforelse
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('statistics.cards') }}" class="text-yellow-600 hover:text-yellow-800 font-semibold">
                        Вся статистика карточек →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection