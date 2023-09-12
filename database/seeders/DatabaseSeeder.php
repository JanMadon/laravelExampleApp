<?php



namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // te seedy bedą odpalane:
        $this->call(
            [GenresSeeder::class,
             GamesSeeder::class]); //php artisan db:seed

            //  jeśli chemy tylko pojedyczgo seeda
            //  php artisan db:seed --class GameSeeder
    }
}
