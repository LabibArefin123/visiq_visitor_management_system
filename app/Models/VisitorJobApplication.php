<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorJobApplication extends Model
{
    use HasFactory;

    protected $table = 'visitor_job_applications';

    protected $fillable = [
        'application_id',
        'name',
        'phone',
        'email',
        'position',
        'resume',
        'status',
        'application_date',
    ];

    protected $casts = [
        'application_date' => 'date',
    ];
}
