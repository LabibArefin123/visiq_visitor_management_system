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
        'visitor_id',
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

    public function idCard()
    {
        return $this->hasOne(VisitorIdCard::class, 'holder_id');
    }
}
