<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorAlertMessage extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'title', 'message'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
