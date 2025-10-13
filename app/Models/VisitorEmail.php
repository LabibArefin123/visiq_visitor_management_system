<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorEmail extends Model
{
    use HasFactory;

    protected $table = 'visitor_email';
    
    protected $fillable = [
        'visitor_id',
        'national_id',
        'name',
        'phone',
        'email',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}
