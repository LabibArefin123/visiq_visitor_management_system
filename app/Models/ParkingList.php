<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_name',
        'level',
        'status',
        'alloted_by',
    ];
}
