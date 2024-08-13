<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Division;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $divisions = Division::all();

        $employees = [
            [
                'name' => 'Ujang',
                'phone' => '08123456789',
                'position' => 'Developer',
                'division_id' => $divisions->where('name', 'Backend')->first()->id,
                'image' => null,
            ],
            // Tambahkan lebih banyak data karyawan sesuai kebutuhan
        ];

        foreach ($employees as $employee) {
            Employee::create([
                'id' => Str::uuid(),
                'name' => $employee['name'],
                'phone' => $employee['phone'],
                'position' => $employee['position'],
                'division_id' => $employee['division_id'],
                'image' => $employee['image'],
            ]);
        }
    }
}
