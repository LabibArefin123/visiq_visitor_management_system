<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyIncident extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_type',
        'description',
        'reported_by',
        'location',
        'incident_time',
        'status',
    ];
}
