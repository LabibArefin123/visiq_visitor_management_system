<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PendingVisitor;

class PendingVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Md. Rahim Uddin',
            'Nasima Akter',
            'Shafiqul Islam',
            'Mahbub Alam',
            'Jahanara Begum',
            'Sabbir Ahmed',
            'Tania Akter',
            'Faruk Hossain',
            'Ruma Khatun',
            'Shamim Hossain',
            'Parvez Alam',
            'Laila Khatun',
            'Nusrat Jahan',
            'Hasan Mahmud',
            'Rashedul Karim',
            'Anika Rahman',
            'Bashir Uddin',
            'Sadia Islam',
            'Fahim Rahman',
            'Sharmin Akter',
            'Rafiul Islam',
            'Mizanur Rahman',
            'Afsana Begum',
            'Mehedi Hasan',
            'Mim Akter',
            'Rubel Mia',
            'Faria Rahman',
            'Rakibul Hasan',
            'Sumi Akter',
            'Habibur Rahman',
            'Tanjila Begum',
            'Abdul Malek',
            'Sultana Parvin',
            'Alamin Hossain',
            'Fatema Khatun',
            'Kamal Uddin',
            'Minara Begum',
            'Sohag Mia',
            'Khaleda Akter',
            'Rafsan Jani',
            'Sadia Yasmin',
            'Arif Hossain',
            'Tasnim Rahman',
            'Imran Hossain',
            'Nadia Akter',
            'Ruhul Amin',
            'Sakina Begum',
            'Jubayer Hossain',
            'Lamia Akter',
            'Asif Mahmud'
        ];

        $purposes = [
            'Meeting with project manager',
            'Software training session',
            'Hardware maintenance support',
            'Vendor contract discussion',
            'Delivery of office equipment',
            'Client presentation',
            'Official document submission',
            'Job interview',
            'System installation check',
            'Technical audit visit'
        ];

        foreach (range(1, 50) as $i) {
            $randomDate = Carbon::createFromTimestamp(
                rand(
                    strtotime('2025-10-20'),
                    strtotime('2026-02-20')
                )
            );

            $dob = Carbon::now()->subYears(rand(22, 55))->subDays(rand(0, 365));

            PendingVisitor::create([
                'visitor_id'   => 'VST-' . strtoupper(Str::random(6)),
                'national_id'  => rand(1000000000, 9999999999),
                'name'         => $names[$i - 1],
                'email'        => Str::slug(strtolower(explode(' ', $names[$i - 1])[0])) . '@example.com',
                'phone'        => '01' . rand(3, 9) . rand(10000000, 99999999),
                'purpose'      => $purposes[array_rand($purposes)],
                'visit_date'   => $randomDate->format('Y-m-d'),
                'date_of_birth' => $dob->format('Y-m-d'),
            ]);
        }
    }
}
