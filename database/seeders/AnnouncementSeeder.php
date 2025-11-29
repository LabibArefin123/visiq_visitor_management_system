<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define start and end range
        $startRange = Carbon::create(2025, 11, 1);
        $endRange = Carbon::create(2026, 2, 1);

        // List of friendly announcement templates
        $titles = [
            'Office Wi-Fi Maintenance',
            'Monthly Staff Meeting',
            'New Cafeteria Menu Available',
            'Fire Drill Scheduled',
            'HR Policy Update',
            'Team Building Activity',
            'IT System Upgrade',
            'Public Holiday Notice',
            'Air Conditioning Maintenance',
            'New Employee Orientation',
            'Parking Lot Reshuffle',
            'Cleaning Schedule Update',
            'Annual Performance Review Notice',
            'Emergency Contact Reminder',
            'Visitor Management System Update',
        ];

        $descriptions = [
            'Please note that the office Wi-Fi will be down for maintenance during the scheduled time.',
            'All staff are requested to attend the monthly meeting in the main conference room.',
            'Check out the new menu options available at the cafeteria starting this week.',
            'A fire drill will be conducted to ensure everyone knows the evacuation procedure.',
            'HR has updated the leave and attendance policies. Please review carefully.',
            'Join us for a fun team building activity this month. Registration is open.',
            'The IT department will perform a system upgrade; some applications may be temporarily unavailable.',
            'The office will remain closed on the upcoming public holiday. Plan your work accordingly.',
            'Air conditioning maintenance is scheduled; please adjust your workspace if necessary.',
            'Welcome our new team members! Orientation sessions will be held in the training room.',
            'Parking lot reshuffle notice: please check your allocated slots to avoid inconvenience.',
            'Office cleaning schedule has been updated. Kindly keep workspaces tidy.',
            'Annual performance reviews will begin next week. Supervisors will contact employees individually.',
            'Please update your emergency contact details in the HR system to ensure safety compliance.',
            'The visitor management system has been upgraded for better tracking and reporting.',
        ];

        // Number of announcements to create
        $total = 50;

        for ($i = 0; $i < $total; $i++) {
            // Random start date
            $startDate = $faker->dateTimeBetween($startRange, $endRange);
            $startDateCarbon = Carbon::instance($startDate)->startOfDay();

            // Random end date (0-5 days after start date, sometimes null)
            $endDate = rand(0, 1) ? $startDateCarbon->copy()->addDays(rand(1, 5)) : null;

            Announcement::create([
                'title' => $faker->randomElement($titles),
                'description' => $faker->randomElement($descriptions),
                'start_date' => $startDateCarbon->format('Y-m-d'),
                'end_date' => $endDate?->format('Y-m-d'),
                'status' => $faker->randomElement(['Active', 'Inactive']),
            ]);
        }
    }
}
