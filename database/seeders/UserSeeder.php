<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        for ($i = 0; $i < 25; $i++) {
            User::factory()
                ->create()
                ->assignRole('employee');
        }

        User::factory()->create([
            'email' => 'employee@igorjoz.com',
        ])->assignRole('employee');

        User::factory()->create([
            'email' => 'admin@igorjoz.com',
        ])->assignRole('admin');

        User::factory()->create([
            'email' => 'superadmin@igorjoz.com',
        ])->assignRole('Super-Admin');
    }
}
