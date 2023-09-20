<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
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

        return view('home.main', ['user' => $user]);
    }
}


//
