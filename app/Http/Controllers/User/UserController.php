<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show()
    {
        return view('me.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function edit()
    {
        return view('me.edit', [
            'user' => Auth::user(),
        ]);
    }

    // validacja przez form request validation (zalecane): 
    public function update(UpdateUserProfile $request) // wystarczy tylko tu inection zrobić i walidacja bezie zrobiona
    {    
        // pobranie zwalidowanych danych:
        $data = $request->validated(); // w tablicy znajdą sie tylkoo dane validated
       // dd($data);


        return redirect() // przekierowanie na strone
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }


    // 'zwykła walidacja':
    public function updateValidetionRules(Request $request)
    {

        $request->validate([
            //wymagany, unikalnyW:tablicy, format emaila
            'email' => ['required', 'unique:users', 'email'], // pole 'email' ma dane reguły
            'name' => ['required', 'max:12']
        ]);

        // dd($request->all());
        return redirect() // przekierowanie na strone
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }
}
