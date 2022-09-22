<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\DepartmentUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $departments = Department::get();

        foreach ($users as $user) {
            $amountOfDepartments = fake()->numberBetween(1, 5);

            for ($i = 0; $i < $amountOfDepartments; $i++) {
                $randomDepartmentId = fake()->numberBetween(0, 6);
                $randomDepartment = $departments[$randomDepartmentId];
                $user->departments()->syncWithoutDetaching($randomDepartment);
            }
        }
    }
}
