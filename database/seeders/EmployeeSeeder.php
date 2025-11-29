<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Employee::create([
                'emp_id' => 'EMPIT' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => 'IT Support ' . $i,
                'national_id' => '1900000009' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'date_of_birth' => now()->subYears(rand(22, 35))->subDays(rand(1, 365))->format('Y-m-d'),
                'department' => 'IT',
                'phone' => '01710' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'email' => 'itsupport' . $i . '@company.com',
            ]);
        }
    }
    // public function run()
    // {
    //     $faker = Faker::create();

    //     $departments = ['HR', 'Finance', 'IT', 'Marketing', 'Operations', 'Sales', 'Customer Support'];

    //     $baseNationalId = 190000000001; // Starting national ID
    //     $basePhone = 1710000000;       // Base phone number (will add $i each time)

    //     for ($i = 1; $i <= 15; $i++) {
    //         $name = $faker->name();
    //         $username = strtolower(str_replace(' ', '', $name)); // remove spaces for email

    //         DB::table('employees')->insert([
    //             'emp_id'        => 'EMP' . str_pad($i, 4, '0', STR_PAD_LEFT),
    //             'name'          => $name,
    //             'department'    => $faker->randomElement($departments),
    //             'phone'         => '0' . ($basePhone + $i), // sequential phone
    //             'email'         => $username . '@gmail.com',
    //             'national_id'   => $baseNationalId + ($i - 1), // sequential increment
    //             'date_of_birth' => $faker->dateTimeBetween('1970-01-01', '2000-12-31')->format('Y-m-d'),
    //             'created_at'    => now(),
    //             'updated_at'    => now(),
    //         ]);
    //     }
    // }
}
