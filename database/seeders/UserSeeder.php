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
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'phone_number' => '+48' . fake()->randomNumber(9),
            'description' => fake()->text(200),
            'email' => 'employee@employeesdir.test',
        ])->assignRole('employee');

        User::factory()->create([
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'phone_number' => '+48' . fake()->randomNumber(9),
            'description' => fake()->text(200),
            'email' => 'admin@employeesdir.test',
        ])->assignRole('admin');

        User::factory()->create([
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'phone_number' => '+48' . fake()->randomNumber(9),
            'description' => fake()->text(200),
            'email' => 'superadmin@employeesdir.test',
        ])->assignRole('Super-Admin');
    }
}
