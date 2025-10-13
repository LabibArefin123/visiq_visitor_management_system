<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeApproval extends Model
{
    use HasFactory;

    // Table name if it differs from the plural form of the class name
    protected $table = 'employee_approvals';

    // Fillable fields to prevent mass-assignment issues
    protected $fillable = [
        'visitor_id',
        'employee_id',
        'status', // Pending, Approved, etc.
    ];

    // Defining relationships
    // Each employee approval is linked to one visitor
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    // Each employee approval is linked to one employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Accessors & Mutators (if necessary)
    // For example, if you want to format the approval status:
    // public function getStatusAttribute($value)
    // {
    //     return ucfirst($value); // Capitalize the first letter of status
    // }

    // Any other custom logic or methods related to EmployeeApproval
}
    