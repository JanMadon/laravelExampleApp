<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\LogTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Route::get('/', function () {
//     return view('welcome');
// });

//Lekcja >>> kozystanie z template boodstrapa

//homepage


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Home\MainPage');




    // USERS
    Route::get('/users', 'UserController@list')
        ->name('get.users');

    Route::get('/users/{userId}', 'UserController@show')
        ->name('get.user.show');

    // GAMES queryBilder
    Route::group([
        'prefix' => 'b/games',
        'namespace' => 'Game',
        'as' => 'games.b.'
    ], function () { // grupowanie i dodawanie prefiksu

        Route::get('dashboard', 'BuilderController@dashboard')
            ->name('dashboard');

        Route::get('', "BuilderController@index")
            ->name('list');

        Route::get('{gameId}', 'BuilderController@show')
            ->name('show');
    });

    // GAMES eloguent
    Route::group([
        'prefix' => 'e/games',
        'namespace' => 'Game',
        'as' => 'games.e.',
        // 'middleware' => 'profiling'
    ], function () {

        Route::get('dashboard', 'EloquentController@dashboard')
            ->name('dashboard');

        Route::get('', "EloquentController@index")
            ->name('list');

        Route::get('{gameId}', 'EloquentController@show')
            ->name('show');
        // ->middleware('profiling'); lub
        // ->middleware(LogTime::class)
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group([
        'prefix' => 'games',
        'namespace' => 'Game',
        'as' => 'games.',
        // 'middleware' => 'profiling'
    ], function () {

        Route::get('', "GameController@index")
            ->name('list');

        Route::get('dashboard', 'GameController@dashboard')
            ->name('dashboard');

        Route::get('{gameId}', 'GameController@show')
            ->name('show');
    });

    // USER - ME
    Route::group([
        'prefix' => 'me',
        'namespace' => 'User',
        'as' => 'me.'
    ], function () {

        Route::get('profile', 'UserController@show')
            ->name('profile');

        Route::get('edit', 'UserController@edit')
            ->name('edit');

        Route::post('update', 'UserController@update')
            ->name('update');


        //listing/ dodanie gry/ usuniedie gry/ ocena
        Route::get('games', 'GameController@list')
            ->name('games.list');

        Route::post('games', 'GameController@add')
            ->name('games.add');

        Route::delete('games', 'GameController@remove')
            ->name('games.remove');

        Route::post('games/rate', 'GameController@rate')
            ->name('games.rate');
    });
});



Auth::routes();
