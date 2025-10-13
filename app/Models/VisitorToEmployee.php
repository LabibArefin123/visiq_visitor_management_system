<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorToEmployee extends Model
{
    use HasFactory;

    protected $table = 'visitor_to_employees';

    protected $fillable = [
        'visitor_id',
        'employee_id',
        'status',
        'assigned_date',
    ];

    /**
     * Get the visitor associated with this assignment.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Get the employee associated with this assignment.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
