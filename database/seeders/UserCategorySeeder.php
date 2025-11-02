<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Admin (main role)', 'category_name_in_bangla' => 'অ্যাডমিন', 'description' => 'Full control over the entire system'],
            ['category_name' => 'Receiptionist', 'category_name_in_bangla' => 'রিসেপশনিস্ট', 'description' => 'Handles visitor operations'],
            ['category_name' => 'Guard', 'category_name_in_bangla' => 'গার্ড', 'description' => 'Manages entry/exit and gate verification'],
            ['category_name' => 'Employee', 'category_name_in_bangla' => 'কর্মী', 'description' => 'Internal staff being visited'],
            ['category_name' => 'Visitor', 'category_name_in_bangla' => 'অতিথি', 'description' => 'Guest or external visitor'],
            ['category_name' => 'IT Officer', 'category_name_in_bangla' => 'আইটি অফিসার', 'description' => 'Handles system maintenance and support'],
        ];

        DB::table('user_categories')->insert($categories);
    }
}
