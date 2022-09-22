<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departmentNames = [
            'IT',
            'Research & Development',
            'Finanse',
            'Administracja',
            'Kadra',
            'Obsługa klienta',
            'Marketing i sprzedaż',
        ];

        foreach ($departmentNames as $departmentName) {
            Department::factory()->create([
                'name' => $departmentName,
                'description' => fake()->text(500),
            ]);
        }
    }
}
