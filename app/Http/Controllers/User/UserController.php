<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function edit() {
        return view('me.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request) {

        $request->validate([
                        //wymagany, unikalnyW:tablicy, format emaila
            'email' => ['required','unique:users', 'email'], // pole 'email' ma dane reguły
            'name' => ['required', 'max:12']
        ]);
        
        // dd($request->all());
        return redirect() // przekierowanie na strone
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }
}
