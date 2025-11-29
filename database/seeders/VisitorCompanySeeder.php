<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorCompany;
use Illuminate\Support\Str;

class VisitorCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['Grameenphone Ltd.', 'Mohammad Rahman'],
            ['Robi Axiata Limited', 'Sadia Hasan'],
            ['Banglalink Digital Communications Ltd.', 'Tanvir Ahmed'],
            ['Apex Footwear Ltd.', 'Nusrat Jahan'],
            ['Square Pharmaceuticals Ltd.', 'Arif Chowdhury'],
            ['BRAC Bank Ltd.', 'Mehedi Hasan'],
            ['Walton Hi-Tech Industries PLC', 'Rafiul Karim'],
            ['Beximco Group', 'Rashedul Islam'],
            ['Akij Group', 'Tasnim Ara'],
            ['PRAN-RFL Group', 'Sakib Mahmud'],
            ['IFAD Group', 'Sadia Alam'],
            ['City Bank Ltd.', 'Shakil Khan'],
            ['LankaBangla Finance Ltd.', 'Jamil Hossain'],
            ['Renata Ltd.', 'Kawsar Ahmed'],
            ['Aarong', 'Farzana Haque'],
            ['Bashundhara Group', 'Fahim Reza'],
            ['Summit Power Ltd.', 'Nadia Karim'],
            ['ACI Limited', 'Shamim Rahman'],
            ['IDLC Finance Ltd.', 'Nasrin Akter'],
            ['Dutch-Bangla Bank Ltd.', 'Imran Hossain'],
        ];

        foreach ($companies as $index => $data) {
            $companyId = 'COMP-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            VisitorCompany::create([
                'company_id'     => $companyId,
                'company_name'   => $data[0],
                'contact_person' => $data[1],
                'email'          => strtolower(Str::slug($data[0], '.')) . '@gmail.com',
                'phone'          => '01' . rand(3, 9) . rand(10000000, 99999999),
                'address'        => rand(10, 99) . ' ' . ['Dhanmondi', 'Banani', 'Uttara', 'Gulshan', 'Mirpur', 'Motijheel', 'Mohakhali'][rand(0, 6)] . ', Dhaka',
                'city'           => 'Dhaka',
                'country'        => 'Bangladesh',
            ]);
        }
    }
}
