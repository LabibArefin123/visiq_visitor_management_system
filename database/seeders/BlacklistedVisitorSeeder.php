<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlacklistedVisitor;
use Carbon\Carbon;

class BlacklistedVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            ['name' => 'Arif Hossain', 'company' => 'Grameenphone Ltd.'],
            ['name' => 'Sadia Rahman', 'company' => 'Robi Axiata Limited'],
            ['name' => 'Tanvir Ahmed', 'company' => 'bKash Limited'],
            ['name' => 'Farzana Islam', 'company' => 'Square Pharmaceuticals Ltd.'],
            ['name' => 'Rafiul Karim', 'company' => 'BRAC Bank Limited'],
            ['name' => 'Mithila Chowdhury', 'company' => 'Unilever Bangladesh'],
            ['name' => 'Ahsan Habib', 'company' => 'ACI Limited'],
            ['name' => 'Nafisa Khan', 'company' => 'Nestlé Bangladesh Ltd.'],
            ['name' => 'Sazzad Mahmud', 'company' => 'Walton Group'],
            ['name' => 'Rima Akter', 'company' => 'Apex Footwear Ltd.'],
            ['name' => 'Imran Hasan', 'company' => 'Pathao Ltd.'],
            ['name' => 'Rokeya Begum', 'company' => 'Transcom Group'],
            ['name' => 'Maruf Ahmed', 'company' => 'Daraz Bangladesh'],
            ['name' => 'Faria Nupur', 'company' => 'IFIC Bank Limited'],
            ['name' => 'Sakibul Islam', 'company' => 'Beximco Pharmaceuticals Ltd.'],
            ['name' => 'Sumaiya Sultana', 'company' => 'Banglalink Digital Communications Ltd.'],
            ['name' => 'Jubayer Rahman', 'company' => 'City Bank Ltd.'],
            ['name' => 'Sharmin Jahan', 'company' => 'PRAN-RFL Group'],
            ['name' => 'Ziaul Haque', 'company' => 'Dutch-Bangla Bank Limited'],
            ['name' => 'Tania Alam', 'company' => 'Meghna Group of Industries'],
            ['name' => 'Rashedul Hasan', 'company' => 'Omera Petroleum Ltd.'],
            ['name' => 'Mahmudul Hasan', 'company' => 'Eastern Bank Limited'],
            ['name' => 'Sadia Karim', 'company' => 'Singer Bangladesh Ltd.'],
            ['name' => 'Nayem Chowdhury', 'company' => 'BAT Bangladesh'],
            ['name' => 'Anika Tasnim', 'company' => 'Bashundhara Group'],
        ];

        foreach ($names as $index => $person) {
            BlacklistedVisitor::create([
                'blacklist_id' => 'B-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'name' => $person['name'],
                'phone' => '01' . rand(3, 9) . rand(10000000, 99999999),
                'reason' => fake()->randomElement([
                    'Security concern at company premises',
                    'Repeated misconduct with staff',
                    'Breach of visitor policy',
                    'Suspicious behavior during visit',
                    'Unauthorized access attempt',
                    'Violation of company privacy rules',
                ]),
                'blacklisted_at' => Carbon::createFromTimestamp(
                    fake()->dateTimeBetween('2024-10-20', '2025-02-20')->getTimestamp()
                ),
                'national_id' => rand(1000000000, 9999999999),
            ]);
        }
    }
}
