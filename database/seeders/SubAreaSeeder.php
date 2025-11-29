<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubAreaSeeder extends Seeder
{
    public function run(): void
    {
        $subAreas = [
            // 🏙️ Barishal (area_id = 1)
            ['area_id' => 1, 'sub_area_name' => 'Barishal Sadar', 'sub_area_name_in_bangla' => 'বরিশাল সদর'],
            ['area_id' => 1, 'sub_area_name' => 'Babuganj', 'sub_area_name_in_bangla' => 'বাবুগঞ্জ'],
            ['area_id' => 1, 'sub_area_name' => 'Bakerganj', 'sub_area_name_in_bangla' => 'বাকেরগঞ্জ'],
            ['area_id' => 1, 'sub_area_name' => 'Muladi', 'sub_area_name_in_bangla' => 'মুলাদী'],
            ['area_id' => 1, 'sub_area_name' => 'Wazirpur', 'sub_area_name_in_bangla' => 'ওয়াজিরপুর'],
            ['area_id' => 1, 'sub_area_name' => 'Agailjhara', 'sub_area_name_in_bangla' => 'আগৈলঝাড়া'],
            ['area_id' => 1, 'sub_area_name' => 'Banaripara', 'sub_area_name_in_bangla' => 'বানারিপাড়া'],
            ['area_id' => 1, 'sub_area_name' => 'Mehendiganj', 'sub_area_name_in_bangla' => 'মেহেন্দিগঞ্জ'],
            ['area_id' => 1, 'sub_area_name' => 'Hizla', 'sub_area_name_in_bangla' => 'হিজলা'],

            // 🌆 Chattogram (area_id = 2)
            ['area_id' => 2, 'sub_area_name' => 'Agrabad', 'sub_area_name_in_bangla' => 'আগ্রাবাদ'],
            ['area_id' => 2, 'sub_area_name' => 'Halishahar', 'sub_area_name_in_bangla' => 'হালিশহর'],
            ['area_id' => 2, 'sub_area_name' => 'Pahartali', 'sub_area_name_in_bangla' => 'পাহাড়তলী'],
            ['area_id' => 2, 'sub_area_name' => 'Chandgaon', 'sub_area_name_in_bangla' => 'চাঁদগাঁও'],
            ['area_id' => 2, 'sub_area_name' => 'Kotwali', 'sub_area_name_in_bangla' => 'কোতয়ালি'],
            ['area_id' => 2, 'sub_area_name' => 'Bakolia', 'sub_area_name_in_bangla' => 'বাকলিয়া'],
            ['area_id' => 2, 'sub_area_name' => 'Patenga', 'sub_area_name_in_bangla' => 'পতেঙ্গা'],
            ['area_id' => 2, 'sub_area_name' => 'Sitakunda', 'sub_area_name_in_bangla' => 'সীতাকুণ্ড'],
            ['area_id' => 2, 'sub_area_name' => 'Raozan', 'sub_area_name_in_bangla' => 'রাউজান'],
            ['area_id' => 2, 'sub_area_name' => 'Boalkhali', 'sub_area_name_in_bangla' => 'বোয়ালখালী'],

            // 🏢 Dhaka (area_id = 3)
            ['area_id' => 3, 'sub_area_name' => 'Dhanmondi', 'sub_area_name_in_bangla' => 'ধানমন্ডি'],
            ['area_id' => 3, 'sub_area_name' => 'Gulshan', 'sub_area_name_in_bangla' => 'গুলশান'],
            ['area_id' => 3, 'sub_area_name' => 'Banani', 'sub_area_name_in_bangla' => 'বনানী'],
            ['area_id' => 3, 'sub_area_name' => 'Mirpur', 'sub_area_name_in_bangla' => 'মিরপুর'],
            ['area_id' => 3, 'sub_area_name' => 'Uttara', 'sub_area_name_in_bangla' => 'উত্তরা'],
            ['area_id' => 3, 'sub_area_name' => 'Mohammadpur', 'sub_area_name_in_bangla' => 'মোহাম্মদপুর'],
            ['area_id' => 3, 'sub_area_name' => 'Badda', 'sub_area_name_in_bangla' => 'বাড্ডা'],
            ['area_id' => 3, 'sub_area_name' => 'Motijheel', 'sub_area_name_in_bangla' => 'মতিঝিল'],
            ['area_id' => 3, 'sub_area_name' => 'Tejgaon', 'sub_area_name_in_bangla' => 'তেজগাঁও'],
            ['area_id' => 3, 'sub_area_name' => 'Ramna', 'sub_area_name_in_bangla' => 'রমনা'],
            ['area_id' => 3, 'sub_area_name' => 'Keraniganj', 'sub_area_name_in_bangla' => 'কেরানীগঞ্জ'],
            ['area_id' => 3, 'sub_area_name' => 'Savar', 'sub_area_name_in_bangla' => 'সাভার'],
            ['area_id' => 3, 'sub_area_name' => 'Tongi (Gazipur)', 'sub_area_name_in_bangla' => 'টঙ্গী (গাজীপুর)'],
            ['area_id' => 3, 'sub_area_name' => 'Narayanganj', 'sub_area_name_in_bangla' => 'নারায়ণগঞ্জ'],
            ['area_id' => 3, 'sub_area_name' => 'Demra', 'sub_area_name_in_bangla' => 'ডেমরা'],

            // 🏭 Khulna (area_id = 4)
            ['area_id' => 4, 'sub_area_name' => 'Sonadanga', 'sub_area_name_in_bangla' => 'সোনাডাঙ্গা'],
            ['area_id' => 4, 'sub_area_name' => 'Khalishpur', 'sub_area_name_in_bangla' => 'খালিশপুর'],
            ['area_id' => 4, 'sub_area_name' => 'Daulatpur', 'sub_area_name_in_bangla' => 'দৌলতপুর'],
            ['area_id' => 4, 'sub_area_name' => 'Rupsha', 'sub_area_name_in_bangla' => 'রূপসা'],
            ['area_id' => 4, 'sub_area_name' => 'Batiaghata', 'sub_area_name_in_bangla' => 'বটিয়াঘাটা'],
            ['area_id' => 4, 'sub_area_name' => 'Dighalia', 'sub_area_name_in_bangla' => 'দিঘলিয়া'],
            ['area_id' => 4, 'sub_area_name' => 'Terokhada', 'sub_area_name_in_bangla' => 'তেরোখাদা'],
            ['area_id' => 4, 'sub_area_name' => 'Paikgacha', 'sub_area_name_in_bangla' => 'পাইকগাছা'],
            ['area_id' => 4, 'sub_area_name' => 'Dumuria', 'sub_area_name_in_bangla' => 'ডুমুরিয়া'],

            // 🌾 Mymensingh (area_id = 5)
            ['area_id' => 5, 'sub_area_name' => 'Mymensingh Sadar', 'sub_area_name_in_bangla' => 'ময়মনসিংহ সদর'],
            ['area_id' => 5, 'sub_area_name' => 'Trishal', 'sub_area_name_in_bangla' => 'ত্রিশাল'],
            ['area_id' => 5, 'sub_area_name' => 'Muktagacha', 'sub_area_name_in_bangla' => 'মুক্তাগাছা'],
            ['area_id' => 5, 'sub_area_name' => 'Bhaluka', 'sub_area_name_in_bangla' => 'ভালুকা'],
            ['area_id' => 5, 'sub_area_name' => 'Fulbaria', 'sub_area_name_in_bangla' => 'ফুলবাড়িয়া'],
            ['area_id' => 5, 'sub_area_name' => 'Gouripur', 'sub_area_name_in_bangla' => 'গৌরীপুর'],
            ['area_id' => 5, 'sub_area_name' => 'Ishwarganj', 'sub_area_name_in_bangla' => 'ঈশ্বরগঞ্জ'],
            ['area_id' => 5, 'sub_area_name' => 'Gafargaon', 'sub_area_name_in_bangla' => 'গফরগাঁও'],

            // 🏛️ Rajshahi (area_id = 6)
            ['area_id' => 6, 'sub_area_name' => 'Boalia', 'sub_area_name_in_bangla' => 'বোয়ালিয়া'],
            ['area_id' => 6, 'sub_area_name' => 'Motihar', 'sub_area_name_in_bangla' => 'মতিহার'],
            ['area_id' => 6, 'sub_area_name' => 'Rajpara', 'sub_area_name_in_bangla' => 'রাজপাড়া'],
            ['area_id' => 6, 'sub_area_name' => 'Paba', 'sub_area_name_in_bangla' => 'পবা'],
            ['area_id' => 6, 'sub_area_name' => 'Godagari', 'sub_area_name_in_bangla' => 'গোদাগাড়ী'],
            ['area_id' => 6, 'sub_area_name' => 'Puthia', 'sub_area_name_in_bangla' => 'পুঠিয়া'],
            ['area_id' => 6, 'sub_area_name' => 'Tanore', 'sub_area_name_in_bangla' => 'তানোর'],
            ['area_id' => 6, 'sub_area_name' => 'Charghat', 'sub_area_name_in_bangla' => 'চারঘাট'],
            ['area_id' => 6, 'sub_area_name' => 'Bagha', 'sub_area_name_in_bangla' => 'বাঘা'],

            // 🌄 Rangpur (area_id = 7)
            ['area_id' => 7, 'sub_area_name' => 'Mahiganj', 'sub_area_name_in_bangla' => 'মহিগঞ্জ'],
            ['area_id' => 7, 'sub_area_name' => 'Gangachara', 'sub_area_name_in_bangla' => 'গঙ্গাচড়া'],
            ['area_id' => 7, 'sub_area_name' => 'Pirgachha', 'sub_area_name_in_bangla' => 'পীরগাছা'],
            ['area_id' => 7, 'sub_area_name' => 'Kaunia', 'sub_area_name_in_bangla' => 'কাউনিয়া'],
            ['area_id' => 7, 'sub_area_name' => 'Mithapukur', 'sub_area_name_in_bangla' => 'মিঠাপুকুর'],
            ['area_id' => 7, 'sub_area_name' => 'Taraganj', 'sub_area_name_in_bangla' => 'তারাগঞ্জ'],
            ['area_id' => 7, 'sub_area_name' => 'Badarganj', 'sub_area_name_in_bangla' => 'বদরগঞ্জ'],
            ['area_id' => 7, 'sub_area_name' => 'Haragach', 'sub_area_name_in_bangla' => 'হরগাছ'],

            // 🌿 Sylhet (area_id = 8)
            ['area_id' => 8, 'sub_area_name' => 'Zindabazar', 'sub_area_name_in_bangla' => 'জিন্দাবাজার'],
            ['area_id' => 8, 'sub_area_name' => 'Amberkhana', 'sub_area_name_in_bangla' => 'আম্বরখানা'],
            ['area_id' => 8, 'sub_area_name' => 'Shahjalal Upashahar', 'sub_area_name_in_bangla' => 'শাহজালাল উপশহর'],
            ['area_id' => 8, 'sub_area_name' => 'Tilaghar', 'sub_area_name_in_bangla' => 'তিলগাঁও'],
            ['area_id' => 8, 'sub_area_name' => 'South Surma', 'sub_area_name_in_bangla' => 'দক্ষিণ সুরমা'],
            ['area_id' => 8, 'sub_area_name' => 'Balaganj', 'sub_area_name_in_bangla' => 'বালাগঞ্জ'],
            ['area_id' => 8, 'sub_area_name' => 'Beanibazar', 'sub_area_name_in_bangla' => 'বিয়ানীবাজার'],
            ['area_id' => 8, 'sub_area_name' => 'Golapganj', 'sub_area_name_in_bangla' => 'গোলাপগঞ্জ'],
            ['area_id' => 8, 'sub_area_name' => 'Fenchuganj', 'sub_area_name_in_bangla' => 'ফেঞ্চুগঞ্জ'],
            ['area_id' => 8, 'sub_area_name' => 'Bishwanath', 'sub_area_name_in_bangla' => 'বিশ্বনাথ'],
        ];

        DB::table('sub_areas')->insert($subAreas);
    }
}
