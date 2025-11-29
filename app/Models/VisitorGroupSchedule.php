<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitorGroupSchedule extends Model
{
    use HasFactory;

    protected $table = 'visitor_group_schedules';

    protected $fillable = [
        'visitor_group_id',
        'employee_id',
        'meeting_date',
        'purpose',
        'status',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function visitorGroup()
    {
        return $this->belongsTo(visitorGroupMember::class, 'visitor_group_id');
    }
}
