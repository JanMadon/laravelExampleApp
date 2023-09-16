<?php
// php artisan make:model Game
// jeden model na jedną tabelę
namespace App\Models;

use App\Models\Scopes\LastWeekScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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



    //relations
    public function genre(): BelongsTo
    {

        return $this->belongsTo(Genre::class);
        /*
        w przypadku belongsTo do klucza obcego bierze nazwę metody a nie klasy jak w hasMany
        */
    }

     //scopeGlobal - tworzymy instacjie klasy którą wczeńsniej stworzyliścmy
     protected static function booted()
     {
         static::addGlobalScope(new LastWeekScope());
     }


    //scope local
    public function scopeBest(Builder $query): Builder
    {
        return $query->where('score', '>', 9);
    }

    public function scopeGenree(builder $query, int $genreId): Builder
    {
        return $query->where('genre_id', $genreId);
    }

}
