<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeeAttendanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $employees = Employee::all();

        $startDate = now()->setDate(2025, 11, 1);
        $endDate   = now()->setDate(2026, 2, 20);

        foreach ($employees as $employee) {
            // Random chance an employee will have attendance at all
            if ($faker->boolean(80)) { // 80% chance employee has some attendance records
                // Random number of attendance days
                $attendanceDays = $faker->numberBetween(5, 20);

                for ($i = 0; $i < $attendanceDays; $i++) {
                    $checkInDate = $faker->dateTimeBetween($startDate, $endDate);
                    $checkOutDate = clone $checkInDate;

                    DB::table('employee_attendances')->insert([
                        'employee_id'   => $employee->id,
                        'check_in_date' => $checkInDate->format('Y-m-d'),
                        'check_in_time' => $faker->dateTimeBetween('08:00:00', '10:00:00')->format('H:i:s'),
                        'check_out_date' => $checkOutDate->format('Y-m-d'),
                        'check_out_time' => $faker->dateTimeBetween('16:00:00', '19:00:00')->format('H:i:s'),
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
            // Some employees will have 0 attendance — intentionally skipped
        }
    }
}
