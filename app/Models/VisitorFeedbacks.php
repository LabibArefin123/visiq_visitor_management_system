<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorFeedbacks extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'pending_visitor_id',
        'feedback_text',
        'rating',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    // Relationships
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function pendingVisitor()
    {
        return $this->belongsTo(PendingVisitor::class, 'pending_visitor_id');
    }
}
