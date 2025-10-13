<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeReport extends Model
{
    protected $table = 'employee_reports'; // Adjust if necessary

    protected $fillable = ['employee_id'];

    /**
     * Relationship with Employee
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Relationship with CheckInEmployee
     */
    public function checkIns(): HasMany
    {
        return $this->hasMany(CheckInEmployee::class, 'employee_id');
    }

    /**
     * Relationship with CheckOutEmployee
     */
    public function checkOuts(): HasMany
    {
        return $this->hasMany(CheckOutEmployee::class, 'employee_id');
    }
}
