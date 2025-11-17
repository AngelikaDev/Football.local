@extends('layouts.app')

@section('title', 'Бомбардиры - Статистика - Английская Премьер-лига')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-futbol text-green-500 mr-3"></i>
                Бомбардиры Премьер-лиги
            </h1>
            <a href="{{ route('statistics.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Назад к статистике
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
                <h2 class="text-2xl font-bold mb-2">Топ снайперов сезона</h2>
                <p class="text-green-100">Рейтинг лучших бомбардиров Английской Премьер-лиги</p>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Позиция</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Игрок</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Позиция</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Страна</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Голы</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Среднее</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($scorers as $index => $scorer)
                                                <tr class="hover:bg-gray-50 transition">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <span
                                                                class="w-8 h-8 bg-green-100 text-green-800 rounded-full flex items-center justify-center font-semibold">
                                                                {{ $index + 1 }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            @if($scorer->player && $scorer->player->photo)
                                                                <img src="{{ asset('storage/' . $scorer->player->photo) }}"
                                                                    alt="{{ $scorer->player->name }}" class="w-10 h-10 rounded-full mr-3">
                                                            @else
                                                                <div
                                                                    class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                                                    <i class="fas fa-user text-gray-400"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <div class="font-semibold text-gray-900">
                                                                    {{ $scorer->player->name ?? 'Неизвестный игрок' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $scorer->player && $scorer->player->position == 'Нападающий' ? 'bg-red-100 text-red-800' :
                                ($scorer->player && $scorer->player->position == 'Полузащитник' ? 'bg-yellow-100 text-yellow-800' :
                                    ($scorer->player && $scorer->player->position == 'Защитник' ? 'bg-blue-100 text-blue-800' :
                                        'bg-gray-100 text-gray-800')) }}">
                                                            {{ $scorer->player->position ?? 'Не указана' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $scorer->player->country ?? 'Не указана' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <span class="text-2xl font-bold text-green-600">{{ $scorer->goals_count }}</span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                        {{ $scorer->goals_count }} гол(ов)
                                                    </td>
                                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-600">
                                        <i class="fas fa-futbol text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-xl">Нет данных о бомбардирах</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Статистика по позициям</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php
                    $positions = [
                        'Нападающий' => ['color' => 'red', 'count' => 0],
                        'Полузащитник' => ['color' => 'yellow', 'count' => 0],
                        'Защитник' => ['color' => 'blue', 'count' => 0],
                        'Вратарь' => ['color' => 'green', 'count' => 0]
                    ];

                    foreach ($scorers as $scorer) {
                        if ($scorer->player && isset($positions[$scorer->player->position])) {
                            $positions[$scorer->player->position]['count']++;
                        }
                    }
                @endphp

                @foreach($positions as $position => $data)
                    <div class="text-center p-4 border rounded-lg">
                        <div class="text-3xl font-bold text-{{ $data['color'] }}-600 mb-2">{{ $data['count'] }}</div>
                        <div class="text-sm text-gray-600">{{ $position }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection