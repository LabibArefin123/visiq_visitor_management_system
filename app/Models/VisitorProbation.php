<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorProbation extends Model
{
    use HasFactory;

    protected $table = 'visitor_probations';

    protected $fillable = [
        'probation_id',
        'name',
        'phone',
        'reason',
        'status',        // pending, approved, cancelled
        'national_id',
        'probation_start',
        'probation_end',
    ];

    protected $casts = [
        'probation_start' => 'datetime',
        'probation_end' => 'datetime',
    ];
}
