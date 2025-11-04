<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalEmergency;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Guard;
use Carbon\Carbon;
use Faker\Factory as Faker;

class MedicalEmergencySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get some random holders
        $employees = Employee::all();
        $visitors  = Visitor::all();
        $guards    = Guard::all();

        $holders = collect([$employees, $visitors, $guards])->flatten();

        $incidentTypes = ['Fire Alarm', 'Medical Emergency', 'Elevator Malfunction', 'Slip & Fall'];

        $locations = [
            'Cafeteria, Ground Floor',
            'Meeting Room 2A',
            'Server Room, 3rd Floor',
            'IT Department',
            'Elevator Shaft B',
            'Lobby, 1st Floor'
        ];

        $statuses = ['Pending', 'In Progress', 'Resolved'];

        $dates = [
            '2025-11-10 10:30:00',
            '2025-12-05 14:15:00',
            '2025-12-20 09:45:00',
            '2026-01-05 21:10:00',
            '2026-01-15 16:45:00',
            '2026-02-01 09:20:00',
        ];

        for ($i = 0; $i < 4; $i++) {
            // Random holder
            $holderType = $faker->randomElement(['employee', 'visitor', 'guard']);
            switch ($holderType) {
                case 'employee':
                    $holder = $employees->random();
                    break;
                case 'visitor':
                    $holder = $visitors->random();
                    break;
                case 'guard':
                    $holder = $guards->random();
                    break;
            }

            MedicalEmergency::create([
                'incident_type'      => $incidentTypes[$i],
                'reported_by_type'   => $holderType,
                'reported_by_id'     => $holder->id,
                'location'           => $locations[$i],
                'incident_time'      => Carbon::parse($dates[$i]),
                'status'             => $statuses[$faker->numberBetween(0, 2)],
                'remarks'            => $faker->sentence(8),
            ]);
        }
    }
}
