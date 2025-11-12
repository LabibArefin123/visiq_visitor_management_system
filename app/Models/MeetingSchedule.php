<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_schedule_id',
        'title',
        'meeting_date',
        'start_time',
        'end_time',
        'description',
        'meeting_type',
        'status',
    ];

    public function officeSchedule()
    {
        return $this->belongsTo(OfficeSchedule::class, 'office_schedule_id');
    }
}
