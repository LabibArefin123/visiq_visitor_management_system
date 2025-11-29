<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyIncident;
use App\Models\Employee;
use Carbon\Carbon;

class EmergencyIncidentSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure employees exist first
        $employees = Employee::pluck('name')->toArray();

        if (empty($employees)) {
            $this->command->warn('⚠️ No employees found! Please seed employees first.');
            return;
        }

        $incidents = [
            [
                'incident_type' => 'Fire Alarm',
                'description'   => 'A small fire broke out in the cafeteria kitchen due to an electrical short circuit. Fire was controlled immediately.',
                'location'      => 'Cafeteria, Ground Floor',
                'incident_time' => Carbon::create(2025, 11, 1, 10, 30),
                'status'        => 'Resolved',
            ],
            [
                'incident_type' => 'Medical Emergency',
                'description'   => 'An employee fainted during a meeting. First aid was provided and they were taken to a nearby hospital.',
                'location'      => 'Meeting Room 2A',
                'incident_time' => Carbon::create(2025, 12, 10, 14, 15),
                'status'        => 'Resolved',
            ],
            [
                'incident_type' => 'Unauthorized Access',
                'description'   => 'Security detected unauthorized access attempt in server room. Access was blocked by system alert.',
                'location'      => 'Server Room, 3rd Floor',
                'incident_time' => Carbon::create(2026, 1, 5, 21, 10),
                'status'        => 'In Progress',
            ],
            [
                'incident_type' => 'Data Breach Attempt',
                'description'   => 'Suspicious external login attempts on internal portal detected. Security team investigating source IP.',
                'location'      => 'IT Department',
                'incident_time' => Carbon::create(2026, 2, 3, 16, 45),
                'status'        => 'Pending',
            ],
            [
                'incident_type' => 'Elevator Malfunction',
                'description'   => 'Main elevator stopped between 4th and 5th floor. Maintenance team resolved issue within 30 minutes.',
                'location'      => 'Elevator Shaft B',
                'incident_time' => Carbon::create(2026, 2, 5, 9, 20),
                'status'        => 'Resolved',
            ],
        ];

        foreach ($incidents as $incident) {
            EmergencyIncident::create([
                'incident_type' => $incident['incident_type'],
                'description'   => $incident['description'],
                'reported_by'   => $employees[array_rand($employees)], // random employee name
                'location'      => $incident['location'],
                'incident_time' => $incident['incident_time'],
                'status'        => $incident['status'],
            ]);
        }

        $this->command->info('✅ EmergencyIncidentSeeder completed successfully!');
    }
}
