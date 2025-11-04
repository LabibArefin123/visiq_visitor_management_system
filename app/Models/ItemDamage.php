<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDamage extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_name_in_bangla',
        'quantity',
        'reported_by',
        'remarks',
        'damage_date',
    ];
}
