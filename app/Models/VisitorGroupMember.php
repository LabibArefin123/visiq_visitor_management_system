<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorGroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'gid', 'name', 'email', 'phone', 'purpose'];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
