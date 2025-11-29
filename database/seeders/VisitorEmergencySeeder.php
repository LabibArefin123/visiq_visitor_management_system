<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorEmergency;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VisitorEmergencySeeder extends Seeder
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

        $reasons = [
            'High fever and severe headache',
            'Road accident injury',
            'Asthma attack',
            'Severe chest pain',
            'Food poisoning',
            'High blood pressure emergency',
            'Pregnancy-related complication',
            'Diabetic shock',
            'Unconsciousness due to heat stroke',
            'Burn injury from kitchen fire',
            'Severe bleeding from accident',
            'Sudden breathing problem',
            'Epileptic seizure',
            'Severe dehydration',
            'Electric shock injury',
            'Severe vomiting and diarrhea',
            'Snake bite',
            'Heart attack symptoms',
            'Broken leg from fall',
            'Allergic reaction causing swelling'
        ];

        foreach (range(1, 50) as $i) {
            $randomDate = Carbon::createFromTimestamp(
                rand(
                    strtotime('2025-10-20'),
                    strtotime('2026-02-20')
                )
            );

            VisitorEmergency::create([
                'emergency_id' => 'EMG-' . strtoupper(Str::random(6)),
                'name' => $names[$i - 1],
                'email' => Str::slug(strtolower(explode(' ', $names[$i - 1])[0])) . '@example.com',
                'phone' => '01' . rand(3, 9) . rand(10000000, 99999999),
                'reason' => $reasons[array_rand($reasons)],
                'emergency_at' => $randomDate->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
