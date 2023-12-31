<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function list(Request $request) {
            // dump($bat);
        $users = [];

        $faker = Factory::create();
        $count = $faker->numberBetween(3,15); // losowanie liczby userow w systemie;

        for($i=0; $i<$count; $i++) {
            $users[] = [
                'id' => $faker->numberBetween(1,1000),
                'name' => $faker->firstName
            ];
        }


        // $session = $request->session();
        // $session->put('prevAction', __METHOD__ . ':' . time());
        //dd($session);

        // $session->flash('flashTestParam', 'bylem tu i mnie nie ma'); // istnieje tylko do
        // koncz nastepnego requestu, przydatny do wyswietlenia komunikatu rzytkownikowi

         // praca domowa:

         $announcement = $faker->numberBetween(0,1);
         dump($announcement);
         //$request->session()->flash('message', $announcement);


        return view('user.list',[
              'users' => $users
            //  'users' => []
        ]);
    }

    public function show(Request $request, int $userId){

        // $prevAction = $request->session()->get('prevAction');
        // dump($prevAction);

        //  $request->session()->put('test_tt', null);

        // dump($request->session()->has('test_tt')); // sprawdza czy isnieje i jego wartość ALE:
        // // null -> false <- natomiast inne juz true np. dla  'false' jest true
        // dump($request->session()->exists('test_tt')); // tylko sprzwdza czy insteje

        // $request->session()->forget('test_tt'); // usówa dany klucz wraz z wartoscia sesji
        // dump($request->session()->exists('test_tt'));

        // dump($request->session());
        // $request->session()->flush(); // usówa czałą wartość sesji
        // dump($request->session());

        // dump($request->session()->get('flashTestParam')); // nie wiem dlaczego jest null
        // // może przez route?
        // dd('end');


        // Helper: session(); <- skraca zapis (nie koniecznie trzeba go uzywać nawet lepiej nie) ewentualnei w szblonach blade

        session(['test1' => 'somethink']); // zapis
        dump(session('test1'));            // odczyt





        $faker = Factory::create();

        $user = [
            'id' => $userId,
            'name'=> $faker->name,
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'city' => $faker->city,
            'age' => $faker->numberBetween(12,40),
            'html' => '<b>Bold HTML</b>'
        ];


        return view('user.show', ['user' => $user, 'nick' => "cos"]);
    }


    // public function testBlade(Request $request, int $id){
    //     return view('layout.main', ['idd' => $id]);
    // }






    public function testView(Request $request, int $id){


        return view('user.show',
        ['id' => $id,
         'example' => 'show',
        //  'appName' => 'Nadpicane appName' // nadpisze współdzieloną zmienną
        ]);


                //współdzielenie zmienych przez widoki
                //app-> Providers -> AppServiceProvider.php

    }

    public function testShowResponse(Request $request, int $id) {
        // return "to jest tekst: UserID = " . $id;

        // return response(
        //     'jakieś tam kontent', // content
        //     200,                    //http status
        //     ['Content-type' => 'text/html'] //content type
        // );

        // return response("<h3> to jest obiekt z response: user: . $id </h3>")
        //     ->setStatusCode(200)
        //     ->header('Content-Type', 'text/html')
        //     ->header('Own-Header', 'Laravel');
        // }

                // mieszanka podejciac / with cookie
        // return response(
        //     "<h1> to jest obiekt z response: user: . $id </h1>",
        //     200
        //     )
        //     ->header('Content-Type', 'text/html')
        //     ->cookie('my-best-cookie',
        //              'delicje',
        //               1); // czas zycia w minutach
        // }

                //Redirec: (przekierowanie)

        //return redirect('users'); // przejdzie na aders
        //return redirect()->route('get.move', ['id' => $id]); // możn podać route

        //return redirect()->action('TestController@test');
        //return redirect()->action('Test\MoveController@list', ['id' => $id]); // możn podać route



                // Przekierowanie na zupałnie inną stronę:
        //return redirect()->away('https://google.com');


                // Zwracanie widoków:
       //return view('user.list'); // najprościej

        // return response()
        //     ->view('user.list', ['idd' => $id], 200)
        //     ->header('Content-Type', 'text/html');

        // Zwracaie jesona
        //return response()->json(['id' => $id]);

        }






    public function testShowRequest(int $id, Request $request) {

        $uri = $request->path();//
        $url = $request->url();
        $fullUrl = $request->fullUrl();
        dump($uri, $url, $fullUrl);

        $httpMethod = $request->method();
        if($request->isMethod('get')) {
            dump('to jest get');
        }
        dump($httpMethod);

        // /users/test/23?name=Tom&nick=boss
        $all = $request->all();
        dump($all); // cała tablica atrybutów

        $name = $request->input('name'); // 2 parmetr jest null
        dump($name); // tylko Tom;

        //http://127.0.0.1:8000/users/test/23?name=Tom&nick=boss&game[]=quake&game[]=turock
        $game = $request->input('game.1');
        dump($game); // turock

        $allQuery = $request->query();
        dump($allQuery); // zwarca wszystko co w url'u, all() zwraca też parametry z body zapytania

        $expired = $request->boolean('expired');
        dump($expired);// jeśli jest i ma wartość &expired=true lub 1 to jest TRUE

        $hasparam = $request->has('name');// jeśli istnieje to jest true
        $hasparams = $request->has(['name','nick']);// muszą istnieć oba
        $hasAnyparams = $request->hasAny(['name','nick', 'dupa']);// muszą istnieć oba
        dump($hasparam, $hasparams, $hasAnyparams);// przynajmniej jeden musi istnisć

        $cookies = $request->cookie();// bobiera ciateczna/ wszystkie
        // lub po nazwie (jak poprzednio)
        dump($cookies);

        dd($request);
        dd($id);
    }

    public function testStore(Request $request, int $id) {
        dump('post store');
        if($request->isMethod('post')) {
            dump('to jest post');
        }

        $all = $request->all();
        dump($all);


    }

}
