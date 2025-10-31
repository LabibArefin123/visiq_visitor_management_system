<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'schedule_name',
        'start_time',
        'end_time',
        'status',
    ];

    // Relationship: OfficeSchedule belongs to Organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
