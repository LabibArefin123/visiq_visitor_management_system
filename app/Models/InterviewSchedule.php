<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InterviewSchedule extends Model
{
    use HasFactory;

    protected $table = 'interview_schedules';

    protected $fillable = [
        'candidate_id',
        'employee_id',
        'interview_date',
        'position',
        'status', // pending, completed, cancelled
        'remarks',
    ];

    protected $casts = [
        'interview_date' => 'datetime',
    ];

    // Relationship to Employee (interviewer)
    public function candidate()
    {
        return $this->belongsTo(VisitorJobApplication::class, 'candidate_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
