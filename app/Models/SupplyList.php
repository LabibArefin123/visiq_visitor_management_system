<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyList extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_code',
        'category',
        'unit',
        'quantity',
        'reorder_level',
        'location',
        'remarks',
    ];

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }

    public function itemRequests()
    {
        return $this->hasMany(ItemRequest::class);
    }
}
