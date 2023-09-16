<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Genre extends Model
{
    use HasFactory;

    // public function games(): HasMany
    // {
    //     return $this->hasMany(Game::class);
    // }

}

/* wloquent automatycznie wyszukuję nazwę kolumny po której nastąpi połącznie
()bierze nazwę modelu [Genre] zmienia go na camel-case, małe litery i dopisuje sufix _id: genre_id
a w tabeli gemre szuka po primary key, czyli id.
można też je zmieniać:
return $this->hasMany(Game::class,'genre_id', 'id'); tak jest defoultowo
*/
