<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorGroupHostSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'employee_name',
        'check_in_time',
        'check_out_time'
    ];
}
