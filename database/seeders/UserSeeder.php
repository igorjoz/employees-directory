<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make(env('EMPLOYEE_PASSWORD', 'password')),
        ])->assignRole('employee');

        User::factory()->create([
            'email' => 'admin@igorjoz.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
        ])->assignRole('admin');

        User::factory()->create([
            'email' => 'superadmin@igorjoz.com',
            'password' => Hash::make(env('SUPERADMIN_PASSWORD', 'password')),
        ])->assignRole('Super-Admin');
    }
}
