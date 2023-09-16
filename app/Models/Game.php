<?php
// php artisan make:model Game
// jeden model na jedną tabelę
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory; // <- tego w starszej wersji nie było sprawdz po co to jest
    // protected $table = 'application_games';
    // protected $table = 'games'; // defoult
    // protected $primaryKey = 'email';
    // protected $primaryKey = 'id'; // defoult
    // protected $timestamps = false; // gdy niema kolumny created_at i updated_at

    protected $attributes = [
        // domyśle waryości dla konkretnych kolumn np:
        // 'score' => 5
    ];
}
