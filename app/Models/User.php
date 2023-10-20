<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'userGames')
            ->withPivot('rate') // bez tego wyciąga tylko dane z modelu game
            ->with('genres');
    }

    public function addGame(Game $game): void
    {
        $this->games()->save($game);
    }

    public function hasGame(int $gameId): bool
    {
        //dd( $this->games());
        $game = $this->games()->where('userGames.game_id', $gameId)->first();
        return (bool) $game;
    }

    public function removeGame(Game $game): void
    {
        $aaa = $this->games()->detach($game->id);
        // dd($aaa);
    }


    public function rateGame(Game $game, int $rate)
    {
        $this->games()->updateExistingPivot($game, ['rate' => $rate]);
    }

    public function isAdmin(): bool
    {
        return (bool) $this->admin;
    }
}
