<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_list_id',
        'log_type',
        'quantity',
        'recorded_by',
        'remarks',
        'log_date',
    ];

    public function supplyList()
    {
        return $this->belongsTo(SupplyList::class);
    }
}
