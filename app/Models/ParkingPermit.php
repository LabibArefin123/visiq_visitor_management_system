<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'employee_id',
        'user_category_id',
        'area_id',
        'building_location_id',
        'building_list_id',
        'parking_location_id',
        'parking_list_id',
        'issued_by',
        'issue_date',
        'expiry_date',
        'status',
        'remarks',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

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

    public function issuedByEmployee()
    {
        return $this->belongsTo(Employee::class, 'issued_by');
    }
}
