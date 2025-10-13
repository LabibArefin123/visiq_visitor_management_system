<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'status',
        'notified_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
