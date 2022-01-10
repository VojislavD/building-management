<?php

namespace Database\Seeders;

use App\Models\Company;
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
            'company_id' => Company::factory()->active()->create()->id,
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password')
        ]);

        \App\Models\Apartment::factory(50)->create();

        \App\Models\Task::factory(50)->create();
    }
}
