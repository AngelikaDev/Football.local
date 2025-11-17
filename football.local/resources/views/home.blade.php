<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Футбольная Лига - Главная</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0c4a6e 0%, #059669 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .news-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50">
  
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-futbol text-3xl text-green-300 animate-pulse-slow"></i>
                    <div>
                        <h1 class="text-3xl font-bold">Футбольная Лига</h1>
                        <p class="text-green-200">Следите за лучшими матчами сезона</p>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-green-300 font-semibold hover:text-white transition">Главная</a>
                    <a href="{{ route('matches.index') }}" class="text-white hover:text-green-300 transition">Матчи</a>
                    <a href="{{ route('commands.index') }}" class="text-white hover:text-green-300 transition">Команды</a>
                    <a href="{{ route('news.index') }}" class="text-white hover:text-green-300 transition">Новости</a>
                    <a href="{{ route('standings') }}" class="text-white hover:text-green-300 transition">Турнирная таблица</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-900 to-green-800 text-white py-20">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center animate-fade-in-up">
                <h2 class="text-5xl font-bold mb-4">Добро пожаловать в Футбольную Лигу</h2>
                <p class="text-xl text-blue-100 mb-8">Самые горячие матчи, новости и статистика</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('schedule') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                        <i class="fas fa-calendar-alt mr-2"></i>Расписание матчей
                    </a>
                    <a href="{{ route('standings') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                        <i class="fas fa-trophy mr-2"></i>Турнирная таблица
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="gradient-bg px-6 py-4">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-newspaper mr-3"></i>Последние новости
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($latestNews as $news)
                            <div class="bg-gray-50 rounded-lg overflow-hidden card-hover">
                                @if($news->image)
                                    @php
                                        $imagePath = $news->image;
                                        
                                        if (str_contains($imagePath, 'news/')) {
                                            $imagePath = $news->image;
                                        } else {
                                            $imagePath = 'news/' . basename($news->image);
                                        }
                                    @endphp
                                    @if(Storage::disk('public')->exists($imagePath))
                                    <img src="{{ Storage::url($imagePath) }}" alt="{{ $news->title }}" class="news-image">
                                    @else
                                    <div class="news-image bg-gradient-to-br from-blue-200 to-green-200 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-4xl text-gray-600"></i>
                                    </div>
                                    @endif
                                @else
                                <div class="news-image bg-gradient-to-br from-blue-200 to-green-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-4xl text-gray-600"></i>
                                </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ Str::limit($news->title, 50) }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit(strip_tags($news->content), 80) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-blue-600">
                                            <i class="far fa-calendar mr-1"></i>{{ $news->publish_date->format('d.m.Y') }}
                                        </span>
                                        <a href="{{ route('news.show', $news->id) }}" class="text-green-600 hover:text-green-700 font-medium text-sm">
                                            Читать далее <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-2 text-center py-8">
                                <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">Новостей пока нет</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="text-center mt-6">
                            <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                                Все новости <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
               
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="gradient-bg px-6 py-4">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-clock mr-3"></i>Ближайшие матчи
                        </h2>
                    </div>
                    <div class="p-6">
                        @forelse($upcomingMatches as $match)
                        <div class="border-b border-gray-200 last:border-b-0 py-4">
                            <div class="text-center mb-2">
                                <span class="text-sm text-gray-500">{{ $match->getFormattedDate() }} в {{ $match->getFormattedTime() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-center flex-1">
                                    <div class="font-semibold text-gray-800">{{ $match->host->name ?? 'TBD' }}</div>
                                    @if($match->host->image)
                                        @php
                                            $hostImagePath = $match->host->image;
                                            if (str_contains($hostImagePath, 'commands/')) {
                                                $hostImagePath = $match->host->image;
                                            } else {
                                                $hostImagePath = 'commands/' . basename($match->host->image);
                                            }
                                        @endphp
                                        @if(Storage::disk('public')->exists($hostImagePath))
                                        <img src="{{ Storage::url($hostImagePath) }}" alt="{{ $match->host->name }}" class="h-12 mx-auto mt-2">
                                        @else
                                        <div class="h-12 w-12 mx-auto mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-users text-gray-400"></i>
                                        </div>
                                        @endif
                                    @else
                                    <div class="h-12 w-12 mx-auto mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-users text-gray-400"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="mx-4">
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-lg font-bold">VS</span>
                                </div>
                                <div class="text-center flex-1">
                                    <div class="font-semibold text-gray-800">{{ $match->guest->name ?? 'TBD' }}</div>
                                    @if($match->guest->image)
                                        @php
                                            $guestImagePath = $match->guest->image;
                                            if (str_contains($guestImagePath, 'commands/')) {
                                                $guestImagePath = $match->guest->image;
                                            } else {
                                                $guestImagePath = 'commands/' . basename($match->guest->image);
                                            }
                                        @endphp
                                        @if(Storage::disk('public')->exists($guestImagePath))
                                        <img src="{{ Storage::url($guestImagePath) }}" alt="{{ $match->guest->name }}" class="h-12 mx-auto mt-2">
                                        @else
                                        <div class="h-12 w-12 mx-auto mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-users text-gray-400"></i>
                                        </div>
                                        @endif
                                    @else
                                    <div class="h-12 w-12 mx-auto mt-2 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-users text-gray-400"></i>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-sm text-gray-500">{{ $match->stadiumInfo->name ?? 'Стадион не указан' }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="fas fa-clock text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">Ближайшие матчи не запланированы</p>
                        </div>
                        @endforelse
                        <div class="text-center mt-4">
                            <a href="{{ route('schedule') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                                Все матчи <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

               
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="gradient-bg px-6 py-4">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-trophy mr-3"></i>Турнирная таблица
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="text-left p-3 font-semibold text-gray-700">Команда</th>
                                        <th class="text-center p-3 font-semibold text-gray-700">О</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($standings as $index => $standing)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition">
                                        <td class="p-3">
                                            <div class="flex items-center">
                                                @if($standing['team']->image)
                                                    @php
                                                        $teamImagePath = $standing['team']->image;
                                                        if (str_contains($teamImagePath, 'commands/')) {
                                                            $teamImagePath = $standing['team']->image;
                                                        } else {
                                                            $teamImagePath = 'commands/' . basename($standing['team']->image);
                                                        }
                                                    @endphp
                                                    @if(Storage::disk('public')->exists($teamImagePath))
                                                    <img src="{{ Storage::url($teamImagePath) }}" alt="{{ $standing['team']->name }}" class="h-6 w-6 mr-3">
                                                    @else
                                                    <div class="h-6 w-6 mr-3 bg-gray-200 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-shield-alt text-gray-400 text-xs"></i>
                                                    </div>
                                                    @endif
                                                @else
                                                <div class="h-6 w-6 mr-3 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-shield-alt text-gray-400 text-xs"></i>
                                                </div>
                                                @endif
                                                <span class="font-medium text-gray-800">{{ $standing['team']->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center p-3">
                                            <span class="font-bold text-blue-600">{{ $standing['points'] }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center p-8 text-gray-500">
                                            <i class="fas fa-trophy text-3xl text-gray-400 mb-2"></i>
                                            <p>Данные недоступны</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('standings') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                                Полная таблица <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="gradient-bg text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Футбольная Лига</h3>
                    <p class="text-blue-100">Следите за лучшими футбольными событиями сезона.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Быстрые ссылки</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('matches.index') }}" class="text-blue-100 hover:text-white transition">Матчи</a></li>
                        <li><a href="{{ route('commands.index') }}" class="text-blue-100 hover:text-white transition">Команды</a></li>
                        <li><a href="{{ route('players.index') }}" class="text-blue-100 hover:text-white transition">Игроки</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-blue-100 hover:text-white transition">Новости</a></li>
                        <li><a href="{{ route('schedule') }}" class="text-blue-100 hover:text-white transition">Расписание</a></li>
                        <li><a href="{{ route('standings') }}" class="text-blue-100 hover:text-white transition">Турнирная таблица</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Контакты</h4>
                    <div class="space-y-2 text-blue-100">
                        <p><i class="fas fa-envelope mr-2"></i>info@football-league.com</p>
                        <p><i class="fas fa-phone mr-2"></i>+7 (999) 123-45-67</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-blue-700 mt-8 pt-6 text-center text-blue-200">
                <p>&copy; 2025 Футбольная Лига. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.card-hover').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>