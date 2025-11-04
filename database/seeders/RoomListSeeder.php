<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomList;

class RoomListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            // 🏢 Level 1 (Ground Floor)
            [
                'user_category_id' => 2,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Reception',
                'room_name_in_bangla' => 'অভ্যর্থনা',
                'level' => 1,
                'remarks' => 'Main entry area and visitor handling desk'
            ],
            [
                'user_category_id' => 5,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Waiting Room',
                'room_name_in_bangla' => 'ওয়েটিং রুম',
                'level' => 1,
                'remarks' => 'Visitor waiting area with seating arrangements'
            ],
            [
                'user_category_id' => 3,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Security Room',
                'room_name_in_bangla' => 'নিরাপত্তা কক্ষ',
                'level' => 1,
                'remarks' => 'Guard monitoring and CCTV control room'
            ],
            [
                'user_category_id' => 6,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Server Room',
                'room_name_in_bangla' => 'সার্ভার রুম',
                'level' => 1,
                'remarks' => 'IT and network server maintenance zone'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Cafeteria',
                'room_name_in_bangla' => 'ক্যাফেটেরিয়া',
                'level' => 1,
                'remarks' => 'Cafeteria for all employees and visitors'
            ],

            // 🧑‍💻 Level 2
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Workstation Group A (10 Desks)',
                'room_name_in_bangla' => 'ওয়ার্কস্টেশন গ্রুপ এ (১০ ডেস্ক)',
                'level' => 2,
                'remarks' => 'Clustered desks for 10 employees with open layout'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Meeting Room 201',
                'room_name_in_bangla' => 'মিটিং রুম ২০১',
                'level' => 2,
                'remarks' => 'Small team meeting room near workstations'
            ],
            [
                'user_category_id' => 6,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Printer Station A',
                'room_name_in_bangla' => 'প্রিন্টার স্টেশন এ',
                'level' => 2,
                'remarks' => 'Printer and copier station for shared use'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 202',
                'room_name_in_bangla' => 'রুম ২০২',
                'level' => 2,
                'remarks' => 'Small workroom beside meeting area'
            ],

            // 👔 Level 3 (Boss/Admin floor)
            [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Managing Director Office',
                'room_name_in_bangla' => 'ব্যবস্থাপনা পরিচালক কক্ষ',
                'level' => 3,
                'remarks' => 'Executive room occupying half of the floor'
            ],
            [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Conference Room 3A',
                'room_name_in_bangla' => 'কনফারেন্স রুম ৩এ',
                'level' => 3,
                'remarks' => 'Conference hall for administrative meetings'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Workstation Group B (12 Desks)',
                'room_name_in_bangla' => 'ওয়ার্কস্টেশন গ্রুপ বি (১২ ডেস্ক)',
                'level' => 3,
                'remarks' => 'Employee desk zone beside executive rooms'
            ],

            // 🗂️ Level 4
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 401',
                'room_name_in_bangla' => 'রুম ৪০১',
                'level' => 4,
                'remarks' => 'Team office 1'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 402',
                'room_name_in_bangla' => 'রুম ৪০২',
                'level' => 4,
                'remarks' => 'Team office 2'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Workstation Group C (10 Desks)',
                'room_name_in_bangla' => 'ওয়ার্কস্টেশন গ্রুপ সি (১০ ডেস্ক)',
                'level' => 4,
                'remarks' => 'Open workspace with walking lane'
            ],
            [
                'user_category_id' => 6,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Printer Station B',
                'room_name_in_bangla' => 'প্রিন্টার স্টেশন বি',
                'level' => 4,
                'remarks' => 'Shared printer area for teams'
            ],

            // 💼 Level 5
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 501',
                'room_name_in_bangla' => 'রুম ৫০১',
                'level' => 5,
                'remarks' => 'HR department office'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 502',
                'room_name_in_bangla' => 'রুম ৫০২',
                'level' => 5,
                'remarks' => 'Accounts and finance department'
            ],
            [
                'user_category_id' => 6,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Room 503',
                'room_name_in_bangla' => 'রুম ৫০৩',
                'level' => 5,
                'remarks' => 'IT support and maintenance office'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Workstation Group D (8 Desks)',
                'room_name_in_bangla' => 'ওয়ার্কস্টেশন গ্রুপ ডি (৮ ডেস্ক)',
                'level' => 5,
                'remarks' => 'Small working cluster with shared space'
            ],

            // 🏙️ Level 6 (Top Management)
            [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'CEO Office',
                'room_name_in_bangla' => 'সিইও কক্ষ',
                'level' => 6,
                'remarks' => 'Executive office with city view'
            ],
            [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Conference Room 6A',
                'room_name_in_bangla' => 'কনফারেন্স রুম ৬এ',
                'level' => 6,
                'remarks' => 'High-level meeting room for management'
            ],
            [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Board Room',
                'room_name_in_bangla' => 'বোর্ড রুম',
                'level' => 6,
                'remarks' => 'Board of directors meeting area'
            ],
            [
                'user_category_id' => 4,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'room_name' => 'Pantry (Level 6)',
                'room_name_in_bangla' => 'প্যান্ট্রি (৬ষ্ঠ তলা)',
                'level' => 6,
                'remarks' => 'Pantry for top floor employees'
            ],
        ];

        foreach ($rooms as $room) {
            RoomList::create($room);
        }
    }
}
