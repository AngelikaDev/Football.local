<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommandsController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\StadiumsController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/commands', [CommandsController::class, 'index'])->name('commands.index');
Route::get('/commands/{id}', [CommandsController::class, 'show'])->name('commands.show');
Route::get('/standings', [CommandsController::class, 'standings'])->name('standings');

Route::get('/matches', [MatchesController::class, 'index'])->name('matches.index');
Route::get('/matches/{id}', [MatchesController::class, 'show'])->name('matches.show');
Route::get('/schedule', [MatchesController::class, 'schedule'])->name('schedule'); 
Route::get('/results', [MatchesController::class, 'results'])->name('results');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/players', [PlayersController::class, 'index'])->name('players.index');
Route::get('/players/{id}', [PlayersController::class, 'show'])->name('players.show');
Route::get('/players/position/{position}', [PlayersController::class, 'byPosition'])->name('players.by-position');

Route::get('/stadiums', [StadiumsController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{id}', [StadiumsController::class, 'show'])->name('stadiums.show');

Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
Route::get('/statistics/top-scorers', [StatisticsController::class, 'topScorers'])->name('statistics.scorers');
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
Route::get('/statistics/top-scorers', [StatisticsController::class, 'topScorers'])->name('statistics.scorers');
Route::get('/statistics/cards', [StatisticsController::class, 'cards'])->name('statistics.cards');

// Тестовые маршруты
Route::get('/test', [TestController::class, 'test']);
Route::get('/test-goals', [TestController::class, 'testGoals']);
Route::get('/test-goals-model', [TestController::class, 'testGoalsModel']);
Route::get('/test-yellow-cards', [TestController::class, 'testYellowCards']);
Route::get('/test-red-cards', [TestController::class, 'testRedCards']);
Route::get('/test-cards-models', [TestController::class, 'testCardsModels']);
Route::get('/test-goals-full', [TestController::class, 'testGoalsFull']);
Route::get('/test-matches', [TestController::class, 'testMatches']);
Route::get('/test-upload', function() {
    try {
        $disk = Storage::disk('public');
        $isWritable = $disk->isWritable('test');
        
        $playersFiles = $disk->files('players');
        $commandsFiles = $disk->files('commands');
        $newsFiles = $disk->files('news');
        
        return response()->json([
            'disk_writable' => $isWritable,
            'players_files' => $playersFiles,
            'commands_files' => $commandsFiles,
            'news_files' => $newsFiles,
            'storage_path' => storage_path('app/public'),
            'public_path' => public_path('storage'),
            'app_url' => config('app.url'),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
Route::get('/test-upload', function() {
    try {
        $disk = Storage::disk('public');
        
       
        $testFile = 'test_' . time() . '.txt';
        $testContent = 'Test file content';
        
        $writeSuccess = $disk->put($testFile, $testContent);
        $readContent = $disk->get($testFile);
        $fileExists = $disk->exists($testFile);
 
        if ($fileExists) {
            $disk->delete($testFile);
        }
        
        $playersFiles = $disk->exists('players') ? $disk->files('players') : [];
        $commandsFiles = $disk->exists('commands') ? $disk->files('commands') : [];
        $newsFiles = $disk->exists('news') ? $disk->files('news') : [];
        
        $playersDirExists = $disk->exists('players');
        $commandsDirExists = $disk->exists('commands');
        $newsDirExists = $disk->exists('news');
        
        if (!$playersDirExists) {
            $disk->makeDirectory('players');
        }
        if (!$commandsDirExists) {
            $disk->makeDirectory('commands');
        }
        if (!$newsDirExists) {
            $disk->makeDirectory('news');
        }
        
        return response()->json([
            'write_success' => $writeSuccess,
            'read_content' => $readContent,
            'file_exists' => $fileExists,
            'test_file_created_and_deleted' => true,
            'players_files' => $playersFiles,
            'commands_files' => $commandsFiles,
            'news_files' => $newsFiles,
            'players_dir_exists' => $playersDirExists,
            'commands_dir_exists' => $commandsDirExists,
            'news_dir_exists' => $newsDirExists,
            'storage_path' => storage_path('app/public'),
            'public_path' => public_path('storage'),
            'app_url' => config('app.url'),
            'directories_created' => [
                'players' => !$playersDirExists,
                'commands' => !$commandsDirExists,
                'news' => !$newsDirExists
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

Route::get('/test-images', function() {
    try {
        $disk = Storage::disk('public');
        
    
        $testImages = [
            'players/salah.jpg' => 'Игрок Салах',
            'commands/liverpool.png' => 'Команда Ливерпуль',
            'news/liverpool-arsenal.jpg' => 'Новость о матче'
        ];
        
        $results = [];
        
        foreach ($testImages as $path => $description) {
            $exists = $disk->exists($path);
            $url = $exists ? Storage::url($path) : null;
            $fullPath = $exists ? storage_path('app/public/' . $path) : null;
            
            $results[$path] = [
                'description' => $description,
                'exists' => $exists,
                'url' => $url,
                'full_path' => $fullPath,
                'public_url' => $exists ? url($url) : null,
                'file_size' => $exists ? $disk->size($path) : 0,
                'file_type' => $exists ? $disk->mimeType($path) : null
            ];
        }
        
        return response()->json([
            'test_images' => $results,
            'storage_url_example' => Storage::url('players/salah.jpg'),
            'url_example' => url(Storage::url('players/salah.jpg')),
            'asset_example' => asset('storage/players/salah.jpg')
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ]);
    }
});