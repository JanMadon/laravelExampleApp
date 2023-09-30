<?php

//declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        //dd($userRepository);
        $this->userRepository = $userRepository;
    }

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

    /*
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
*/

    // validacja przez form request validation (zalecane): 
    public function update(UpdateUserProfile $request) // wystarczy tylko tu inection zrobić i walidacja bezie zrobiona
    {
        $user = Auth::user();

        // pobranie zwalidowanych danych:
        $data = $request->validated(); // w tablicy znajdą sie tylkoo dane validated
        $path = null;
        
        if(!empty($data['avatar-clear'])) {
            //dd('usuń avatar');
            $data['avatar'] = null;
            $this->userRepository->updateModel(Auth::user(), $data);
            
        }
       // dd($data);

        if (!empty($data['avatar'])) {
            $path = $data['avatar']->store('avatars', 'public');
            // Wpraowadzienie nowych danych:

            dump($data['avatar']);
            dump($path);
            
            //dd($user->avatar);
            if ($path) {
                $data['avatar'] = $path; 
                $user->avatar ? Storage::disk('public')->delete($user->avatar): '';              
                
                $this->userRepository->updateModel(Auth::user(), $data);

            }
        }
        //   avatars/21mRa6bihIDsfPRN4OS5YHLoeaGIpOzJrUC7rVvs.png
        // user->avatar : avatars/wTjj4YbxAZGTjLomR1BdslRwqrCM88cHXAO58Z9q.png

        //$path = $data['avatar']->storeAs('avatars', Auth::id());







        return redirect() // przekierowanie na strone
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }
}
