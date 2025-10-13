<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckInEmployee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees_check_in';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'name',
        'age',
        'department',
        'check_in_time',
        'status',
        'total_checkins', // Added field
    ];

    /**
     * Set the default value for the status based on the check-in time.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $checkInTime = \Carbon\Carbon::parse($model->check_in_time);
            $defaultTime = \Carbon\Carbon::createFromTime(8, 0, 0);

            $model->status = $checkInTime->greaterThan($defaultTime) ? 'Late' : 'On Time';
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
