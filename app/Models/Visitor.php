<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = [
        'v_id',
        'name',
        'email',
        'phone',
        'purpose',
        'visit_date',
        'date_of_birth',
        'national_id',
        'gender',
       
    ];

    protected $casts = [
        'visit_date' => 'date',
        
      
    ];

    // Get visitor age from date_of_birth
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }

    // Scope to filter by visitor type
   

    // Scope to filter by visit date
    public function scopeByVisitDate($query, $date)
    {
        return $query->whereDate('visit_date', $date);
    }

    public function whatsappEntries()
    {
        return $this->hasMany(VisitorWhatsApp::class, 'visitor_id');
    }

    public function checkins()
    {
        return $this->hasOne(VisitorCheckin::class, 'visitor_id');
    }

    public function checkouts()
    {
        return $this->hasOne(VisitorCheckout::class, 'visitor_id');
    }
}
