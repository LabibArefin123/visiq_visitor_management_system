<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'sub_area_name',
        'sub_area_name_in_bangla',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
