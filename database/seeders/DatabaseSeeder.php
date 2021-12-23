<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password')
        ]);

        \App\Models\Building::factory(50)->create();
    }
}
