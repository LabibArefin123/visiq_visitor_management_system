<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeekendSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_name',
        'working_days',
        'status',
    ];

    protected $casts = [
        'working_days' => 'array',
    ];
}
