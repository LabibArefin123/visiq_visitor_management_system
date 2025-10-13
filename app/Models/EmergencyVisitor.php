<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmergencyVisitor extends Model
{
    use HasFactory;

    protected $table = 'visitor_emergency'; // Database table name

    protected $fillable = [
        'e_id',
        'name',
        'email',
        'phone',
        'reason',
        'emergency_at',
    ];

    protected $dates = ['emergency_at', 'deleted_at'];

    /**
     * Get the formatted emergency date.
     *
     * @return string
     */
    public function getFormattedEmergencyDateAttribute()
    {
        return $this->emergency_at ? $this->emergency_at->format('d-m-Y') : null;
    }
}
