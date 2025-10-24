<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorEmergency extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_id',
        'name',
        'email',
        'phone',
        'reason',
        'emergency_at',
    ];
}
