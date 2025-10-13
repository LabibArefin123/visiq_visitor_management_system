<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bangladeshiNames = [
            'Abdullah Al Mamun',
            'Md. Rakib Hasan',
            'Sadia Islam',
            'Tanjila Akter',
            'Hasibul Haque',
            'Rafsan Jamil',
            'Sumaiya Rahman',
            'Farhan Ahmed',
            'Nusrat Jahan',
            'Sabbir Hossain',
            'Tahmid Chowdhury',
            'Rafiul Islam',
            'Mehjabin Noor',
            'Tanvir Ahmed',
            'Ayesha Siddiqua',
            'Mahmudul Hasan',
            'Nazmul Huda',
            'Fatema Tuz Zohora',
            'Arif Hossain',
            'Samira Khan',
            'Naimul Islam',
            'Tasnim Akter',
            'Zahid Hasan',
            'Jannatul Ferdous',
            'Sajjad Karim',
            'Mithila Rahman',
            'Ruhul Amin',
            'Anika Chowdhury',
            'Tawsif Mahbub',
            'Sadia Zaman',
            'Imran Hossain',
            'Maliha Islam',
            'Shahriar Alam',
            'Faria Tabassum',
            'Rakibul Islam',
            'Anjum Ara',
            'Saifullah Noor',
            'Sumona Ahmed',
            'Kamrul Hasan',
            'Rumana Akter',
            'Nafis Rahman',
            'Samia Sultana',
            'Aminul Islam',
            'Tahsin Alam',
            'Shamsul Haque',
            'Muna Chowdhury',
            'Ashraful Islam',
            'Rima Akter',
            'Rayhan Uddin',
            'Sultana Jahan'
        ];

        foreach ($bangladeshiNames as $name) {
            Visitor::create([
                'visitor_id' => 'V' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'phone' => '01' . rand(3, 9) . rand(10000000, 99999999),
                'purpose' => fake()->randomElement(['Meeting', 'Interview', 'Delivery', 'Personal Visit']),
                'visit_date' => Carbon::now()->subDays(rand(0, 30)),
                'date_of_birth' => Carbon::now()->subYears(rand(20, 50))->subDays(rand(0, 365)),
                'national_id' => rand(1000000000, 9999999999),
                'gender' => fake()->randomElement(['Male', 'Female']),
            ]);
        }
    }
}
