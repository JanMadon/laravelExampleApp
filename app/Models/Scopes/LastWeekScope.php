<?php
// php artisan make:scope LastWeekScope

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Carbon;

class LastWeekScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    // scope grobalny
    public function apply(Builder $builder, Model $model): void
    {
        $currentDate = Carbon::now();
        $pastDates = $currentDate
            ->subDays($currentDate->dayOfWeek)
            ->subWeek();

            // dd($pastDates);


        $builder->where('created_at', '>', $pastDates);
    }
}
