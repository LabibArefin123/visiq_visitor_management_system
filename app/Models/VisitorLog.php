<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $table = 'visitor_activity_logs';

    protected $fillable = [
        'visitor_id', 
        'description'
    ];

    // Disable automatic timestamps if you don't want Eloquent to manage 'created_at' and 'updated_at'
    // If you want Laravel to automatically handle timestamps, keep this line:
    public $timestamps = true; // Default is true, so this line is optional.

    /**
     * Relationship with Visitor
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
