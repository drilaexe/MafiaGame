<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\GameDb;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/games', function () {
    $gameData = GameDb::orderBy('created_at','DESC')
    ->paginate(14);
    return Inertia::render('Games', ['gameData' => $gameData]);
})->middleware(['auth', 'verified'])->name('games');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/createNewGame', [GameController::class, 'createNewGame'])->name('createNewGame');
    Route::get('/game/{id}', [GameController::class, 'game'])->name('game');
    Route::get('/gameFlow', [GameController::class, 'gameFlow'])->name('gameFlow');
});

require __DIR__ . '/auth.php';
