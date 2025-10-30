<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCompany extends Model
{
    use HasFactory;

    protected $table = 'visitor_companies';

    protected $fillable = [
        'company_id',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'country',
    ];
}
