<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_category_id',
        'room_list_id',
        'employee_id',
        'visitor_id',
        'seat_number',
        'employee_name',
        'allocation_date',
        'remarks',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function userCategory()
    {
        return $this->belongsTo(UserCategory::class, 'user_category_id');
    }

    public function room()
    {
        return $this->belongsTo(RoomList::class, 'room_list_id');
    }
}
