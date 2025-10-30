<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorGroupMember extends Model
{
    use HasFactory;

    protected $table = 'visitor_group_members';

    protected $fillable = [
        'group_name',
        'visitor_ids',
        'total_group_members',
    ];

    protected $casts = [
        'visitor_ids' => 'array', // Store as JSON array
    ];
}
