<?php

use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    return view('home.main');
});

Route::get('/users', 'UserController@list');

Route::get('/{userId}', 'UserController@show')
    ->name('get.user.show');

    // lekcja 1 - ROUTING:
 /*
        Route::get('/', function () {
            return view('welcome');
        });

        //Route::get('/hello', 'App\Http\Controllers\HelloController@hello');
        Route::get('/hello/{name}', 'HelloController@hello');


        Route::get('/goodbye/{name}', function ($name) {
        return "goodbay: " . $name;
        });

        $uri = "/example";

        Route::get($uri, fn() => 'jestem z GET' );
        Route::post($uri, fn() => 'jestem z POST');
        Route::put($uri, fn() => 'jestem z PUT');
        Route::patch($uri, fn() => 'jestem z PUTCH');
        Route::delete($uri, fn() => 'jestem z DELETE');
        Route::options($uri, fn() => 'jestem z OPTION');

        Route::match(['get', 'post'], '/match',  fn() => 'jestem getem i postem jednoczesnie');
        Route::any('/any',  fn() => 'wszystkie metody :D');

        Route::view('/view/route', 'route.view');// omija kontroler wyswietla poprostu widok
        // oba dresy jeden widok z podstawionymi parametrami:
        Route::view('//view/route/us1', 'route.viewParam', ['name' => 'zbyszek', 'adres' => 'warszawa']);
        Route::view('//view/route/us2', 'route.viewParam', ['name' => 'janusz', 'adres' => 'kraków']);

        Route::get('posts/{postID}', function (int $postID) {
            var_dump($postID);
            dd($postID);
        } );

        // Route::get('user/{nick?}', function (string $nick = null) {
        //     dd($nick);
        // });

        Route::get('user/{nick}', function (string $nick) {
            dd($nick);
        }) -> where(['nick' => "[a-z]+"]); // wyrażenia regularne w parametrze

        Route::get('item', function() {
        return 'Items';
        }) -> name('shop.items'); // nazwa dla route'y

        Route::get('elements/{id}', function($id){
            return 'Element:' . $id;
        }) -> name('shop.items.single') ;

        Route::get('example2', function() {
            //$url = route('shop.items');                    // http://localhost:8000/item (znajdzie po nazwie)
            $url = route('shop.items.single', ['id' => 33]); // w przypadku gdy jest jakiś paramter w url
            dump($url);                 // przydaje się w widokach
        });


        // php artisan route:cache --keszuje routy co pozwala na ich szybsze wczytanie
        // php artisan route:clear --czysci cache



        // zadanie domowe (routing dla metod z uzyciem kontrolerów):
        Route::get('/job', 'RoutingController@getMethod');
        Route::post('/job', 'RoutingController@postMethod');
        Route::put('/job', 'RoutingController@putMethod');
        Route::delete('/job', 'RoutingController@deleteMethod');

    */

/*
    // lekcja 2 - Controller

    Route::get('users', 'UserController@list')
        -> name('get.users');

    //29 - single action controller.
                    // to jest raczej niestandardowe podejscie do kontrollerów // np. podejscie CQRS (jedna akcja 1 plik)DOCZYTAJ
    Route::get('user/{id}/address', 'User\ShowAddress') // pojedycza akcja więc nie podajemy nazwy akcji po @
    ->where(['id' => '[0-9]+']) // reguła walidacji dla atrybutów
    ->name('get.user.address');

    Route::resource('games', 'GameController');
   // Route::resource('games', 'GameController')
    //->only(['index','show']); // tylko wyszczegulnione


    // do lekicji z routingiem:

    Route::get('/users/test/{id}', 'UserController@testShowRequest')
    ->name('get.users.test');

    Route::post('/users/test/{id}', 'UserController@testStore')
    ->name('post.users.test');

    Route::any('/move/{id}', 'Test\MoveController@list')
    ->name('get.move');

    Route::get('/users/test/{id}', 'UserController@testShowResponse')
    ->name('get.users.test');

    Route::get('test', 'TestController@test')
    ->name('get.test');

    Route::get('/users/test/{id}', 'UserController@testView')
    ->name('get.users.test');

    // Route::get('/users/{userId}', 'UserController@testBlade')
    // ->name('get.users.test');

    Route::get('users/{userId}', 'UserController@show')
    ->name('get.user.show');

*/
