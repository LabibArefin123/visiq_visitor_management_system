<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvacuationPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'description',
        'location',
        'scheduled_date',
        'scheduled_time',
        'status'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime:H:i',
    ];
}
