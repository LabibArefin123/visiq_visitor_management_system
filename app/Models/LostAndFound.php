<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostAndFound extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'item_name',
        'status',
        'location',
        'description',
        'reported_date',
    ];

    protected $casts = [
        'reported_date' => 'date',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
