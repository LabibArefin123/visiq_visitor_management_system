<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',  // Newly added field for Visitor ID
        'national_id',
        'name',
        'email',
        'phone',
        'purpose',
        'visit_date',
        'date_of_birth',
        'status',
        'remarks',
    ];

    // Optional: Mutators for handling date formatting (e.g., Date of Birth) or custom attributes
    protected $dates = [
        'visit_date',
        'date_of_birth',  // Ensures the 'date_of_birth' field is treated as a date
    ];

    // You could also add accessor methods here to display age automatically, if needed
    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->date_of_birth)->age;
    }
}
