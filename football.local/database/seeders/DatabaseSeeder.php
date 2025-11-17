<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadiums;
use App\Models\Players;
use App\Models\Commands;
use App\Models\Matches;
use App\Models\News;
use App\Models\Goals;
use App\Models\YellowCards;
use App\Models\RedCards;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
      
        $stadiums = [
            ['name' => 'Энфилд', 'city' => 'Ливерпуль'],
            ['name' => 'Олд Траффорд', 'city' => 'Манчестер'],
            ['name' => 'Стэмфорд Бридж', 'city' => 'Лондон'],
            ['name' => 'Эмирейтс', 'city' => 'Лондон'],
            ['name' => 'Этихад', 'city' => 'Манчестер']
        ];

        foreach ($stadiums as $stadium) {
            Stadiums::create($stadium);
        }

        $coaches = [
            ['name' => 'Юрген Клопп', 'position' => 'Тренер', 'country' => 'Германия', 'photo' => 'coaches/klop.jpg'],
            ['name' => 'Пеп Гвардиола', 'position' => 'Тренер', 'country' => 'Испания', 'photo' => ''],
            ['name' => 'Микель Артета', 'position' => 'Тренер', 'country' => 'Испания', 'photo' => ''],
            ['name' => 'Эрик тен Хаг', 'position' => 'Тренер', 'country' => 'Нидерланды', 'photo' => ''],
            ['name' => 'Арне Слот', 'position' => 'Тренер', 'country' => 'Нидерланды', 'photo' => '']
            
        ];

        $coachIds = [];
        foreach ($coaches as $coach) {
            $coachIds[] = Players::create($coach)->id;
        }

        $teams = [
            [
                'name' => 'Ливерпуль', 
                'image' => 'teams/liverpool.png', 
                'city' => 'Ливерпуль',
                'coach' => $coachIds[0],
                'stadium' => 1
            ],
            [
                'name' => 'Манчестер Сити', 
                'image' => 'teams/mancity.png', 
                'city' => 'Манчестер',
                'coach' => $coachIds[1],
                'stadium' => 5
            ],
            [
                'name' => 'Арсенал', 
                'image' => 'teams/arsenal.png', 
                'city' => 'Лондон',
                'coach' => $coachIds[2],
                'stadium' => 4
            ],
            [
                'name' => 'Манчестер Юнайтед', 
                'image' => 'teams/manutd.png', 
                'city' => 'Манчестер',
                'coach' => $coachIds[3],
                'stadium' => 2
            ],
            [
                'name' => 'Челси', 
                'image' => 'teams/chelsea.png', 
                'city' => 'Лондон',
                'coach' => $coachIds[0], 
                'stadium' => 3
            ],
            [
                'name' => 'Тоттенхэм', 
                'image' => 'teams/tottenham.png', 
                'city' => 'Лондон',
                'coach' => $coachIds[1], 
                'stadium' => 1 
            ]
        ];

        $teamIds = [];
        foreach ($teams as $team) {
            $teamIds[] = Commands::create($team)->id;
        }

        $players = [
            
            ['name' => 'Мохаммед Салах', 'position' => 'Нападающий', 'country' => 'Египет', 'photo' => 'players/salah.jpg'],
            ['name' => 'Вирджил ван Дейк', 'position' => 'Защитник', 'country' => 'Нидерланды', 'photo' => 'players/vandijk.jpg'],
            ['name' => 'Алиссон Беккер', 'position' => 'Вратарь', 'country' => 'Бразилия', 'photo' => 'players/alisson.jpg'],
            
          
            ['name' => 'Эрлинг Холанн', 'position' => 'Нападающий', 'country' => 'Норвегия', 'photo' => 'players/haaland.jpg'],
            ['name' => 'Кевин Де Брёйне', 'position' => 'Полузащитник', 'country' => 'Бельгия', 'photo' => 'players/debruyne.jpg'],
            ['name' => 'Эдерсон', 'position' => 'Вратарь', 'country' => 'Бразилия', 'photo' => 'players/ederson.jpg'],
 
            ['name' => 'Букайо Сака', 'position' => 'Нападающий', 'country' => 'Англия', 'photo' => 'players/saka.jpg'],
            ['name' => 'Мартин Эдегор', 'position' => 'Полузащитник', 'country' => 'Норвегия', 'photo' => 'players/odegaard.jpg'],
            ['name' => 'Аарон Рамсдейл', 'position' => 'Вратарь', 'country' => 'Англия', 'photo' => 'players/ramsdale.jpg'],

            ['name' => 'Маркус Рэшфорд', 'position' => 'Нападающий', 'country' => 'Англия', 'photo' => 'players/rashford.jpg'],
            ['name' => 'Бруну Фернандеш', 'position' => 'Полузащитник', 'country' => 'Португалия', 'photo' => 'players/fernandes.jpg'],
            ['name' => 'Давид де Хеа', 'position' => 'Вратарь', 'country' => 'Испания', 'photo' => 'players/degea.jpg'],

            ['name' => 'Ромелу Лукаку', 'position' => 'Нападающий', 'country' => 'Бельгия', 'photo' => 'players/lukaku.jpg'],
            ['name' => 'Нголо Канте', 'position' => 'Полузащитник', 'country' => 'Франция', 'photo' => 'players/kante.jpg'],

            ['name' => 'Хари Кейн', 'position' => 'Нападающий', 'country' => 'Англия', 'photo' => 'players/kane.jpg'],
            ['name' => 'Хойбьерг', 'position' => 'Полузащитник', 'country' => 'Дания', 'photo' => 'players/hojbjerg.jpg']
        ];

        $playerIds = [];
        foreach ($players as $player) {
            $playerIds[] = Players::create($player)->id;
        }

        $matches = [
       
            [
                'hosts' => $teamIds[0], 
                'guests' => $teamIds[1], 
                'stadium' => 1,
                'date' => now()->addDays(3),
                'hosts_goals' => 0,
                'guests_goals' => 0
            ],
            [
                'hosts' => $teamIds[2], 
                'guests' => $teamIds[3], 
                'stadium' => 4,
                'date' => now()->addDays(5),
                'hosts_goals' => 0,
                'guests_goals' => 0
            ],
            [
                'hosts' => $teamIds[4], 
                'guests' => $teamIds[5], 
                'stadium' => 3,
                'date' => now()->addDays(7),
                'hosts_goals' => 0,
                'guests_goals' => 0
            ],
            
         
            [
                'hosts' => $teamIds[0], 
                'guests' => $teamIds[2],
                'stadium' => 1,
                'date' => now()->subDays(10),
                'hosts_goals' => 3,
                'guests_goals' => 1
            ],
            [
                'hosts' => $teamIds[1], 
                'guests' => $teamIds[3], 
                'stadium' => 5,
                'date' => now()->subDays(7),
                'hosts_goals' => 2,
                'guests_goals' => 1
            ],
            [
                'hosts' => $teamIds[4],
                'guests' => $teamIds[0], 
                'stadium' => 3,
                'date' => now()->subDays(5),
                'hosts_goals' => 1,
                'guests_goals' => 1
            ]
        ];

        $matchIds = [];
        foreach ($matches as $match) {
            $matchIds[] = Matches::create($match)->id;
        }

        $goals = [
  
            ['match' => $matchIds[3], 'player' => $playerIds[0], 'minutes' => 23, 'seconds' => 0], 
            ['match' => $matchIds[3], 'player' => $playerIds[0], 'minutes' => 67, 'seconds' => 0], 
            ['match' => $matchIds[3], 'player' => $playerIds[1], 'minutes' => 45, 'seconds' => 2], 
            ['match' => $matchIds[3], 'player' => $playerIds[6], 'minutes' => 89, 'seconds' => 0], 
     
            ['match' => $matchIds[4], 'player' => $playerIds[3], 'minutes' => 15, 'seconds' => 0],
            ['match' => $matchIds[4], 'player' => $playerIds[3], 'minutes' => 78, 'seconds' => 0],
            ['match' => $matchIds[4], 'player' => $playerIds[9], 'minutes' => 34, 'seconds' => 0],
          
            ['match' => $matchIds[5], 'player' => $playerIds[12], 'minutes' => 52, 'seconds' => 0],
            ['match' => $matchIds[5], 'player' => $playerIds[0], 'minutes' => 68, 'seconds' => 0],
        ];

        foreach ($goals as $goal) {
            Goals::create($goal);
        }

        $yellowCards = [
            ['match' => $matchIds[3], 'player' => $playerIds[7], 'minutes' => 56, 'seconds' => 0],
            ['match' => $matchIds[4], 'player' => $playerIds[10], 'minutes' => 72, 'seconds' => 0],
            ['match' => $matchIds[5], 'player' => $playerIds[13], 'minutes' => 45, 'seconds' => 0], 
        ];

        foreach ($yellowCards as $card) {
            YellowCards::create($card);
        }

        $redCards = [
            ['match' => $matchIds[3], 'player' => $playerIds[8], 'minutes' => 85, 'seconds' => 0], 
        ];

        foreach ($redCards as $card) {
            RedCards::create($card);
        }

       
        $news = [
            [
                'title' => 'Ливерпуль обыграл Арсенал в захватывающем матче',
                'content' => '<p>В напряженном матче Премьер-лиги Ливерпуль одержал победу над Арсеналом со счетом 3:1. Дубль Салаха и гол Ван Дейка принесли победу хозяевам поля.</p>',
                'image' => 'news/liverpool-arsenal.jpg',
                'publish_date' => now()->subDays(1),
                'is_published' => true
            ],
            [
                'title' => 'Манчестер Сити продолжает победную серию',
                'content' => '<p>Манчестер Сити одержал важную победу над Манчестер Юнайтед. Дубль Холанна стал решающим в этом дерби.</p>',
                'image' => 'news/manchester-derby.jpg',
                'publish_date' => now()->subDays(2),
                'is_published' => true
            ],
            [
                'title' => 'Трансферные слухи: новые приобретения клубов',
                'content' => '<p>В преддверии зимнего трансферного окна клубы Премьер-лиги активно ведут переговоры о новых игроках.</p>',
                'image' => 'news/transfers.jpg',
                'publish_date' => now()->subDays(3),
                'is_published' => true
            ],
            [
                'title' => 'Челси и Ливерпуль сыграли вничью',
                'content' => '<p>В матче выходного дня Челси и Ливерпуль разделили очки. Голы Лукаку и Салаха принесли командам по одному очку.</p>',
                'image' => 'news/chelsea-liverpool.jpg',
                'publish_date' => now()->subDays(4),
                'is_published' => true
            ]
        ];

        foreach ($news as $item) {
            News::create($item);
        }

        $this->command->info('Тестовые данные успешно созданы!');
        $this->command->info('Создано:');
        $this->command->info('- ' . Stadiums::count() . ' стадионов');
        $this->command->info('- ' . Players::count() . ' игроков');
        $this->command->info('- ' . Commands::count() . ' команд');
        $this->command->info('- ' . Matches::count() . ' матчей');
        $this->command->info('- ' . Goals::count() . ' голов');
        $this->command->info('- ' . YellowCards::count() . ' желтых карточек');
        $this->command->info('- ' . RedCards::count() . ' красных карточек');
        $this->command->info('- ' . News::count() . ' новостей');
    }
}