<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_category_id',
        'area_id',
        'building_location_id',
        'building_list_id',
        'parking_location_id',
        'name',
        'name_in_bangla',
        'level',
        'remarks',
    ];

    public function userCategory()
    {
        return $this->belongsTo(UserCategory::class, 'user_category_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function location()
    {
        return $this->belongsTo(BuildingLocation::class, 'building_location_id');
    }

    public function building()
    {
        return $this->belongsTo(BuildingList::class, 'building_list_id');
    }

    public function plocation()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }

    public function allotments()
    {
        return $this->hasMany(ParkingAllotment::class, 'parking_list_id');
    }
}
