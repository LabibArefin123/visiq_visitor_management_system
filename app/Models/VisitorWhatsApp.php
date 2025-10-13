<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorWhatsApp extends Model
{
    use HasFactory;

    protected $table = 'visitor_whatsapp'; // Specify the table name

    protected $fillable = [
        'visitor_id',
        'national_id',
        'name',
        'phone',
        'email',
    ];

    // Define relationship with Visitor model
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
