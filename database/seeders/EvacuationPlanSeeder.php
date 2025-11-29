<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvacuationPlan;
use Carbon\Carbon;

class EvacuationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'plan_name' => 'Fire Drill - Main Office',
                'location' => 'Dhaka Office - Ground Floor',
                'scheduled_date' => Carbon::create(2025, 12, 5),
                'scheduled_time' => '10:00:00',
                'status' => 'completed',
                'description' => 'Fire drill to practice evacuation from ground floor and stairwells.'
            ],
            [
                'plan_name' => 'Earthquake Drill',
                'location' => 'Dhaka Office - All Floors',
                'scheduled_date' => Carbon::create(2025, 12, 15),
                'scheduled_time' => '14:30:00',
                'status' => 'completed',
                'description' => 'Earthquake preparedness drill with safe zones and assembly points.'
            ],
            [
                'plan_name' => 'Medical Emergency Evacuation',
                'location' => 'Dhaka Office - 3rd Floor',
                'scheduled_date' => Carbon::create(2026, 1, 5),
                'scheduled_time' => '11:15:00',
                'status' => 'scheduled',
                'description' => 'Evacuation drill for medical emergency scenario including first aid response.'
            ],
            [
                'plan_name' => 'Fire Drill - IT Department',
                'location' => 'Dhaka Office - IT Department, 2nd Floor',
                'scheduled_date' => Carbon::create(2026, 1, 12),
                'scheduled_time' => '09:45:00',
                'status' => 'scheduled',
                'description' => 'Fire drill focusing on server room evacuation and equipment safety.'
            ],
            [
                'plan_name' => 'Evacuation Drill for Warehouse',
                'location' => 'Dhaka Office - Warehouse',
                'scheduled_date' => Carbon::create(2026, 1, 20),
                'scheduled_time' => '15:00:00',
                'status' => 'scheduled',
                'description' => 'Evacuation plan practice for warehouse staff including emergency exits.'
            ],
            [
                'plan_name' => 'Emergency Power Shutdown Drill',
                'location' => 'Dhaka Office - All Floors',
                'scheduled_date' => Carbon::create(2026, 2, 1),
                'scheduled_time' => '16:30:00',
                'status' => 'scheduled',
                'description' => 'Drill for emergency power outage and safe evacuation procedures.'
            ],
        ];

        foreach ($plans as $plan) {
            EvacuationPlan::create($plan);
        }
    }
}
