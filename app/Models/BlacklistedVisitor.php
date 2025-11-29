<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistedVisitor extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name follows Laravel's convention)
    protected $table = 'blacklisted_visitors';

    // Specify fillable attributes for mass assignment
    protected $fillable = [
        'blacklist_id',
        'name',
        'phone',
        'reason',
        'blacklisted_at',
        'national_id',  // Add 'national_id' to fillable fields
    ];
}
