<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverstayAlert extends Model
{
    use HasFactory;

    protected $table = 'overstay_alerts';

    protected $fillable = [
        'visitor_id',
        'visitor_name',
        'visit_date',
        'expected_checkout_date',
        'actual_checkout_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'expected_checkout_date' => 'date',
        'actual_checkout_date' => 'date',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}
