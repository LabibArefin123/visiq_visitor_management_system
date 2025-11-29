<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingList;
use Carbon\Carbon;

class ParkingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkingData = [];

        for ($i = 1; $i <= 100; $i++) {
            $parkingData[] = [
                'user_category_id' => 1,
                'area_id' => 3,
                'building_location_id' => 1,
                'building_list_id' => 1,
                'parking_location_id' => 1,
                'name' => 'P-' . $i,
                'name_in_bangla' => 'পি - ' . $i,
                'level' => 3,
                'remarks' => 'This is P-' . $i . ' slot in Level 3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        ParkingList::insert($parkingData);
    }
}
