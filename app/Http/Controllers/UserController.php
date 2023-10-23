<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list()
    {

        //(Gate::allows('admin-level'));
        //dump(Gate::denies('admin-level'));

        // if(!Gate::allows('admin-level', [true])) {
        //     abort(403);
        // }

        Gate::authorize('admin-level'); // najprostrzy sposób wywali 403 jesli nie ma dostepu
        // Tak działa:
        // try {
        //     Gate::authorize('admin-level');
        // } catch (\Throwable $th) {
        //     dump($th);
        // }

        // $response = Gate::inspect('admin-level');
        // if($response->denied()) {
        //     echo $response->message();
        //     dd(exit);
        // }

        $users = $this->userRepository->all();

        return view('user.list', [
            'users' => $users
        ]);
    }

    // autoryzacja przez model uzytkownika należy wstrzyknoć request    
    public function show(Request $request, int $userId)
    {

        $user = $request->user();

        //if (!$user->can('admin-level')) {
        // if ($user->cannot('admin-level')) {
        //     abort(403);
        // }

        
        //$this->authorize('admin-level');// to dziala identycznie jak Gate::authorize('admin-level');  


        //dd($request->user());

        //Gate::authorize('admin-level');

        $userModel = $this->userRepository->get($userId);

        // niby Gete a to korzysta z polices(ta polityka pozwoli na syswietlenie szczegoów tylko zalogowanemu uzytkownikowi)
        Gate::authorize('view', $userModel); // view to jest nazwa metody w klasie Policies/UserPolices.php
        //$this->authorize('create', User::class);

        return view('user.show', ['user' => $this->userRepository->get($userId),
         'nick' => "cos"]);
    }
}
