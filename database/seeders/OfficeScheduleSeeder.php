<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfficeSchedule;
use App\Models\Organization;

class OfficeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure at least one organization exists
        $organization = Organization::first();

        if (!$organization) {
            $organization = Organization::create([
                'name' => 'Bangladesh Head Office',
                'address' => 'Dhaka, Bangladesh',
                'email' => 'info@visiq.com.bd',
                'phone' => '+8801000000000',
                'status' => 'active',
            ]);
        }

        // Example office schedules (Bangladesh standard)
        $schedules = [
            [
                'organization_id' => $organization->id,
                'schedule_name'   => 'Regular Office Hours',
                'start_time'      => '09:00:00',
                'end_time'        => '17:00:00',
                'status'          => 'active',
            ],
            [
                'organization_id' => $organization->id,
                'schedule_name'   => 'Half Day (Friday)',
                'start_time'      => '09:00:00',
                'end_time'        => '13:00:00',
                'status'          => 'active',
            ],
            [
                'organization_id' => $organization->id,
                'schedule_name'   => 'Night Shift',
                'start_time'      => '22:00:00',
                'end_time'        => '06:00:00',
                'status'          => 'inactive',
            ],
        ];

        foreach ($schedules as $schedule) {
            OfficeSchedule::create($schedule);
        }
    }
}
