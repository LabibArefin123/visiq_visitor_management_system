<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCheckin extends Model
{
    use HasFactory;

    protected $table = 'visitor_checkins';

    protected $fillable = ['visitor_id', 'age', 'check_in_time', 'status', 'total_checkins'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}

