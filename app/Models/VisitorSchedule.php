<?php

// app/Models/VisitorSchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'v_id',
        'employee_name',
        'check_in_time',
        'check_out_time',
    ];

    /**
     * Relationship with Visitor model.
     * A visitor schedule belongs to one visitor.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'v_id');
    }

    /**
     * Get the visitor's name as an attribute.
     * This is helpful to avoid calling the visitor relationship each time.
     */
    public function getVisitorNameAttribute()
    {
        return $this->visitor ? $this->visitor->name : 'N/A';
    }

    /**
     * Get the visitor's date of birth as an attribute.
     * This is helpful to avoid calling the visitor relationship each time.
     */
    public function getVisitorDobAttribute()
    {
        return $this->visitor ? $this->visitor->date_of_birth : 'N/A';
    }

    /**
     * Get the visitor's age as an attribute.
     * This is helpful to avoid calling the visitor relationship each time.
     */
    public function getVisitorAgeAttribute()
    {
        return $this->visitor ? $this->visitor->age : 'N/A';
    }
}
