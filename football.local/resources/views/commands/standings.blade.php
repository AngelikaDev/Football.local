@extends('layouts.app')

@section('title', 'Турнирная таблица - Английская Премьер-лига')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Турнирная таблица</h1>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Поз.</th>
                    <th class="px-6 py-3 text-left">Команда</th>
                    <th class="px-6 py-3 text-center">И</th>
                    <th class="px-6 py-3 text-center">В</th>
                    <th class="px-6 py-3 text-center">Н</th>
                    <th class="px-6 py-3 text-center">П</th>
                    <th class="px-6 py-3 text-center">ЗМ</th>
                    <th class="px-6 py-3 text-center">ПМ</th>
                    <th class="px-6 py-3 text-center">РМ</th>
                    <th class="px-6 py-3 text-center">О</th>
                </tr>
            </thead>
            <tbody>
                @forelse($standings as $index => $standing)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('storage/' . $standing['team']->image) }}" 
                                 alt="{{ $standing['team']->name }}" 
                                 class="w-8 h-8 rounded-full">
                            <span>{{ $standing['team']->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">{{ $standing['played'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $standing['wins'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $standing['draws'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $standing['losses'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $standing['goals_for'] }}</td>
                    <td class="px-6 py-4 text-center">{{ $standing['goals_against'] }}</td>
                    <td class="px-6 py-4 text-center font-semibold {{ $standing['goal_difference'] > 0 ? 'text-green-600' : ($standing['goal_difference'] < 0 ? 'text-red-600' : 'text-gray-600') }}">
                        {{ $standing['goal_difference'] > 0 ? '+' : '' }}{{ $standing['goal_difference'] }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-yellow-600">{{ $standing['points'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-6 py-8 text-center text-gray-600">
                        Нет данных для отображения таблицы
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection