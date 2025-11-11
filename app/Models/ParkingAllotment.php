<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingAllotment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_category_id',
        'area_id',
        'building_location_id',
        'building_list_id',
        'parking_location_id',
        'parking_list_id',
        'alloted_by',
        'start_date',
        'end_date',
        'status',
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

    public function plist()
    {
        return $this->belongsTo(ParkingList::class, 'parking_list_id');
    }

    public function allottedByEmployee()
    {
        return $this->belongsTo(Employee::class, 'alloted_by');
    }
}
