<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCheckInAI extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'name', 'purpose', 'dob', 'captured_image', 'check_in_time', 'status'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}
