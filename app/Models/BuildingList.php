<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_category_id',
        'area_id',
        'building_location_id',
        'name',
        'name_in_bangla',
        'level',
        'unit_per_level',
        'remarks',
    ];

    public function category()
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
}
