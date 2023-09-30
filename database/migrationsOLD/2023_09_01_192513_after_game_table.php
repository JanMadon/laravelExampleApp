<?php
// php artisan make:migration after_game_table


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // zmiany które chcemy wprowadzić
        Schema::table('games', function (Blueprint $table) {
            $table->string('title', 50)->change();
            $table->dropColumn('score');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // komeda przywracająca stan tabeli przed migracją
        Schema::table('games', function (Blueprint $table) {
            $table->string('title', 100)->change();
            $table->float('score')->nullable();
            $table->dropIndex('game_title_index');

        });
    }
};
