<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitorCompany extends Model
{
    use HasFactory;

    protected $table = 'visitor_companies';

    protected $fillable = [
        'contact_person',
        'phone',
        'company_name',
        'purpose',
        'visit_date',
        'date_of_birth',
        'national_id',
        'gender',
        'visitor_type',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'date_of_birth' => 'date',
    ];

    // Get visitor age dynamically
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }

    // Scope to filter by visit date
    public function scopeByVisitDate($query, $date)
    {
        return $query->whereDate('visit_date', $date);
    }
}
