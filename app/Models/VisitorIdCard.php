<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorIdCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'holder_type',
        'holder_id',
        'issue_date',
        'expiry_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function holder()
    {
        return match ($this->holder_type) {
            'visitor' => $this->belongsTo(Visitor::class, 'holder_id'),
            default => null,
        };
    }
}
