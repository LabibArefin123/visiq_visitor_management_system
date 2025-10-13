<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCheckout extends Model
{
    use HasFactory;

    protected $table = 'visitor_checkouts'; // Added table name

    protected $fillable = [
        'visitor_id',  // Added visitor_id for foreign key reference
        'age',
        'purpose',
        'check_out_time',
        'total_checkouts', // Added total_checkouts
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}