<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;

    protected $fillable = [
        'guard_id',
        'name',
        'phone',
        'email',
        'shift',
        'assigned_gate',
        'status',
    ];
}
