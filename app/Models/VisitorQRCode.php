<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorQRCode extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'qr_code_path'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
