<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitorHostSchedule extends Model
{
    use HasFactory;

    protected $table = 'visitor_host_schedules';

    protected $fillable = [
        'visitor_id',
        'employee_id',
        'meeting_date',
        'purpose',
        'status',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    // Relationships
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
