<?php

/*
php artisan migrate // migracja (coś jak git commit)
php artisan migrate:rollback // cofa ostatnie zmiany migracji
php artisan migrate:ststus
php artisan make:migration create_games_table <- tworzy migrację
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { // twzorzy tabele
        Schema::dropIfExists('games');

        Schema::create('games', function (Blueprint $table) { // kozysta z polaczenia domyslnego
    // Schema::connection('mysql')->create('users', function ($table) {}); // tutaj jawnie okreslamy z ktorego ma skorzytać.
            $table->id();
            $table->string('title', 100); //->nullable()->charset('utf8');
            $table->text('dexcription')->nullable();
            $table->string('publisher', 100)->comment('game publisher');
            $table->float('score')->nullable();
            $table->timestamps();
        });

        // Schema::rename('from', "to"); // zmiana nazwy tabeli

        // if (Schema::hasTable('table')) {
        //     //wykonaj  jaśli istnieje tabala o tej nazwie
        // };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games'); // usuń tabele jeśli istnieje
    }
};

