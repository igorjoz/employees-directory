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
        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@employeesdir.test',
        ])->assignRole('employee');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@employeesdir.test',
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@employeesdir.test',
        ])->assignRole('Super-Admin');
    }
}
