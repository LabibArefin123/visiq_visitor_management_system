<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_code',
        'phone',
        'email',
        'address',
        'contact_person',
        'contact_phone',
    ];
}
