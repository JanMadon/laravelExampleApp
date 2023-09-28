<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Game\GameController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainPage extends Controller {

    public function __invoke(Request $request)
    {
        // uzyskanie danych zalogowanego uzytkownika:
        //$user = Auth::user(); // sposób 1
        $user = $request->user(); // sposób 2
        $id = Auth::id();
        //dd($user);
        //dd($id);
        //Auth::logout(); wyloguje

        $gameId = 44;
        $url = url("gemes/$gameId");
        $url = url()->current();// aktulany url ale bez query parameters
        //$url = url()->full(); //pełna scieżka z parametrami
        $url = url()->previous(); //url poprzedniej strony

        $routUrl = route('games.show', ['gameId' => $gameId, // to jest parametr wymagany (zawartu w sciezce)
                                            'foo' => 'bar']); // a to są gwury paramiters po ?

        $actionUrl = action([GameController::class, 'dashboard'], ['foo'=>'bar']); // ganeruje url z danygo kontrolera, i nazwy metody 

        // dump($actionUrl);
        // dump($routUrl);
        // dump($url);
        // dd('exit');
        return view('home.main', ['user' => $user]);
    }
}


//
