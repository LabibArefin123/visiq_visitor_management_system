<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessHistoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_point_guard_id',
        'log_date',
        'accessed_at',
        'left_at',
    ];

    public function assignPoint()
    {
        return $this->belongsTo(AssignPointGuard::class, 'assign_point_guard_id');
    }
}
