<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPointGuard extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_point_id',
        'guard_id',
        'shift_start',
        'shift_end',
    ];

    public function accessPoint()
    {
        return $this->belongsTo(AccessPoint::class);
    }

    public function guard_module()
    {
        return $this->belongsTo(Guard::class, 'guard_id');
    }
}
