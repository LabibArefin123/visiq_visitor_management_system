<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistMonitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'blacklisted_visitor_id',
        'monitor_date',
        'checked_in_at',
        'checked_out_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(BlacklistedVisitor::class, 'blacklisted_visitor_id');
    }
}
