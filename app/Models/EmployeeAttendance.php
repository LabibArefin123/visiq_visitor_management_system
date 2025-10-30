<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in_date',
        'check_in_time',
        'check_out_date',
        'check_out_time',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
