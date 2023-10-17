<?php

namespace App\Repository\Eloquent;


use App\Models\User;
use App\Repository\UserRepository as RepositoryUserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository implements RepositoryUserRepository
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function updateModel(User $user, array $data): void
    {
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->avatar = $data['avatar'] ?? null;
    
        $user->save();
    }

    public function all(): Collection //
    {
        
        return $this->userModel->get();
    }

    public function get(int $id): User //
    {
        return $this->userModel->find($id);
    }
}
