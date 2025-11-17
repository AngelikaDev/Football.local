<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Футбольная Лига')</title>
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
    </style>
</head>
<body class="bg-gray-50">
    
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-4">
                        <i class="fas fa-futbol text-3xl text-green-300 animate-pulse-slow"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Футбольная Лига</h1>
                            <p class="text-green-200">Следите за лучшими матчами сезона</p>
                        </div>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-green-300 font-semibold hover:text-white transition">Главная</a>
                    <a href="{{ route('matches.index') }}" class="text-white hover:text-green-300 transition">Матчи</a>
                    <a href="{{ route('commands.index') }}" class="text-white hover:text-green-300 transition">Команды</a>
                    <a href="{{ route('players.index') }}" class="text-white hover:text-green-300 transition">Игроки</a>
                    <a href="{{ route('news.index') }}" class="text-white hover:text-green-300 transition">Новости</a>
                    <a href="{{ route('standings') }}" class="text-white hover:text-green-300 transition">Турнирная таблица</a>
                    <a href="{{ route('statistics.index') }}" class="text-white hover:text-green-300 transition">Статистика</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
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