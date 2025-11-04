<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalEmergency extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_type',
        'reported_by_type',
        'reported_by_id',
        'location',
        'incident_time',
        'status',
        'remarks',
    ];

    protected $casts = [
        'incident_time' => 'datetime',
    ];

    public function reporter()
    {
        return match ($this->reported_by_type) {
            'employee' => $this->belongsTo(Employee::class, 'reported_by_id'),
            'visitor' => $this->belongsTo(Visitor::class, 'reported_by_id'),
            'guard' => $this->belongsTo(Guard::class, 'reported_by_id'),
            default => null,
        };
    }
}
