<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    // Define the fillable fields
    protected $fillable = [
        'E_id',
        'profile_picture', // Added Profile Picture field
        'name',
        'national_id',  // Added National ID
        'department',   // Use department_id if using a relationship
        'phone',
        'email',
        'age',          // Remove if calculated dynamically
        'dob',          // Added Date of Birth
        'expected_checkout_time', // New field for expected checkout time
        'total_checkouts', // Track the number of checkouts
    ];

    // Calculate age dynamically
    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : null;
    }

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    /**
     * Relationship: Check-In Records
     */
    public function checkInRecords()
    {
        return $this->hasMany(CheckInEmployee::class);
    }

    /**
     * Relationship: Check-Out Records
     */
    public function checkOutRecords()
    {
        return $this->hasMany(CheckOutEmployee::class);
    }

    public function checkIns()
    {
        return $this->hasOne(CheckInEmployee::class, 'employee_id');
    }

    public function checkOuts()
    {
        return $this->hasOne(CheckOutEmployee::class, 'employee_id');
    }
    
    //for checkin and checkout in attendance tracking
    public function checkIn()
    {
        return $this->hasOne(CheckInEmployee::class, 'employee_id');
    }

    public function checkOut()
    {
        return $this->hasOne(CheckOutEmployee::class, 'employee_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class,  'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getExpectedCheckoutTimeAttribute($value)
    {
        return $value ?: '21:00'; // Default to 9:00 PM if not set
    }

    public function isOverdueCheckout($checkOutTime)
    {
        $expectedCheckoutTime = \Carbon\Carbon::createFromFormat('H:i', $this->expected_checkout_time);
        return $checkOutTime->gt($expectedCheckoutTime); // Late if checkout is after expected time
    }
    
}
