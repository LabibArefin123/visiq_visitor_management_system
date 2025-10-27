<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    // Define the fillable fields
    protected $fillable = [
        'emp_id',
        'name',
        'department',
        'phone',
        'email',
        'national_id',
        'date_of_birth',
    ];

    // Calculate age dynamically
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }
}
