<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorJobApplication;
use Carbon\Carbon;

class VisitorJobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Software Engineer',
            'HR Officer',
            'Accountant',
            'Receptionist',
            'Security Officer',
            'Marketing Executive',
            'Office Assistant',
            'Project Coordinator'
        ];

        $names = [
            'Md. Arif Hossain',
            'Sadia Rahman',
            'Tanvir Ahmed',
            'Farzana Islam',
            'Rafiul Karim',
            'Mahmudul Hasan',
            'Nusrat Jahan',
            'Khaled Mahmud',
            'Jannatul Ferdous',
            'Sabbir Alam',
            'Mim Akter',
            'Rashedul Islam',
            'Nabila Chowdhury',
            'Aminul Haque',
            'Shamima Akter'
        ];

        $phones = [
            '01710000001',
            '01820000002',
            '01930000003',
            '01640000004',
            '01550000005',
            '01712000006',
            '01833000007',
            '01945000008',
            '01656000009',
            '01567000010',
            '01778000011',
            '01889000012',
            '01999000013',
            '01611000014',
            '01522000015'
        ];

        for ($i = 0; $i < 15; $i++) {
            VisitorJobApplication::create([
                'application_id' => 'APP' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'name' => $names[$i],
                'phone' => $phones[$i],
                'email' => 'user' . ($i + 1) . '@example.com',
                'position' => $positions[array_rand($positions)],
                'status' => ['pending', 'approved', 'rejected'][array_rand([0, 1, 2])],
                'application_date' => Carbon::create(2025, 11, 15)->addDays(rand(0, 98)), // up to 20 Feb 2026
            ]);
        }
    }
}
