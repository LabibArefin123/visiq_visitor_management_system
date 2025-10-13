<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'employee_id',
        'status',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
