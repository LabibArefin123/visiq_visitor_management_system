<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitorReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'check_in_time',
        'check_out_time',
        'total_checkins',
        'total_checkouts',
    ];

    // Relationship with Visitor
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    // Calculate visit duration
    public function getDurationAttribute()
    {
        if ($this->check_out_time) {
            return Carbon::parse($this->check_in_time)->diff(Carbon::parse($this->check_out_time))->format('%H:%I:%S');
        }
        return 'N/A';
    }

}
