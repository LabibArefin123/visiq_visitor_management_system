<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_list_id',
        'requester_name',
        'department',
        'request_type',
        'quantity',
        'status',
        'remarks',
    ];

    public function supplyList()
    {
        return $this->belongsTo(SupplyList::class);
    }
}
