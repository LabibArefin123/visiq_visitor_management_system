<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    // Add all relevant fields to the fillable array
    protected $fillable = ['employee_id', 'check_in', 'check_out', 'date', 'status'];

    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    /**
     * Define the relationship with the Employee model.
     */
    public function checkIn()
    {
        return $this->hasOne(CheckInEmployee::class, 'employee_id');
    }

    // Relationship with VisitorCheckout
    public function checkOut()
    {
        return $this->hasOne(CheckOutEmployee::class, 'employee_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Accessor for formatted check-in time.
     */
    public function getFormattedCheckInAttribute()
    {
        return $this->check_in ? date('h:i A', strtotime($this->check_in)) : 'N/A';
    }

    /**
     * Accessor for formatted check-out time.
     */
    public function getFormattedCheckOutAttribute()
    {
        return $this->check_out ? date('h:i A', strtotime($this->check_out)) : 'N/A';
    }

    /**
     * Mutator to ensure the date is always stored in Y-m-d format.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
