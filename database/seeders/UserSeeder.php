<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::factory()->active()->create();

        $super_admin = \App\Models\User::create([
            'company_id' => $company->id,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '0641234567',
            'password' => bcrypt('password')
        ]);

        $admin = \App\Models\User::create([
            'company_id' => $company->id,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '0641234567',
            'password' => bcrypt('password')
        ]);

        $user = \App\Models\User::create([
            'company_id' => $company->id,
            'name' => 'User',
            'email' => 'user@example.com',
            'phone' => '0641234567',
            'password' => bcrypt('password')
        ]);


        $super_admin->assignRole('super_admin');
        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
