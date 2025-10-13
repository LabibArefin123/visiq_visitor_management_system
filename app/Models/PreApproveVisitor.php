<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreApproveVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'purpose',
        'visit_date',
        'contact_number',
        'email',
    ];
}
