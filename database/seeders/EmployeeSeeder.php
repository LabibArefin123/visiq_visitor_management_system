<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $departments = ['HR', 'Finance', 'IT', 'Marketing', 'Operations', 'Sales', 'Customer Support'];

        $baseNationalId = 190000000001; // Starting national ID
        $basePhone = 1710000000;       // Base phone number (will add $i each time)

        for ($i = 1; $i <= 15; $i++) {
            $name = $faker->name();
            $username = strtolower(str_replace(' ', '', $name)); // remove spaces for email

            DB::table('employees')->insert([
                'emp_id'       => 'EMP' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name'         => $name,
                'department'   => $faker->randomElement($departments),
                'phone'        => '0' . ($basePhone + $i), // sequential phone
                'email'        => $username . '@gmail.com',
                'national_id'  => $baseNationalId + ($i - 1), // sequential increment
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
