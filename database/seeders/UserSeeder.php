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
            'email' => 'employee@employeesdir.test',
        ])->assignRole('employee');

        User::factory()->create([
            'email' => 'admin@employeesdir.test',
        ])->assignRole('admin');

        User::factory()->create([
            'email' => 'superadmin@employeesdir.test',
        ])->assignRole('Super-Admin');
    }
}
