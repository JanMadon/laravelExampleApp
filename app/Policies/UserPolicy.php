<?php // php artisan make:policy UserPolicy --model=User 
// po dodaniu --model=User tworzy poszczególne metody

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool // mamy dostep tylko gdy nasze id jest ruwne id które chcemy wyswietlić
    {
        return $user->id === $model->id; 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
       // dd($user);
       return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
