<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOutEmployee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees_check_out';

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
        'expected_check_out_time', // New field added
        'check_out_time',
        'status',
        'total_checkouts',
    ];

    /**
     * Define the relationship with the Employee model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Set the default value for the status based on the check-out time.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // **Set expected check-out time to 9 PM by default**
            $model->expected_check_out_time = Carbon::createFromTime(21, 0)->format('H:i');

            // Determine check-out status
            if ($model->check_out_time) {
                $checkOutTime = Carbon::parse($model->check_out_time);
                $defaultTime = Carbon::createFromTime(21, 0); // 9:00 PM
                $model->status = $checkOutTime->greaterThan($defaultTime) ? 'Late' : 'Regular';
            } else {
                $model->status = 'Pending';
            }
        });
    }
}
