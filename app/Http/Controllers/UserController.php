<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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

    public function show(int $userId)
    {
        Gate::authorize('admin-level');
        $user = $this->userRepository->get($userId);
        return view('user.show', ['user' => $user, 'nick' => "cos"]);
    }
}
