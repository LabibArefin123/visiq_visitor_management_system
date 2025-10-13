<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitorAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'age',
        'check_in_time',
        'check_out_time',
        'total_checkins',
        'total_checkouts',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function getDurationAttribute()
    {
        if ($this->check_in_time && $this->check_out_time) {
            $checkIn = Carbon::parse($this->check_in_time);
            $checkOut = Carbon::parse($this->check_out_time);
            return $checkOut->diff($checkIn)->format('%h hours %i minutes');
        }
        return 'N/A';
    }
    
}
