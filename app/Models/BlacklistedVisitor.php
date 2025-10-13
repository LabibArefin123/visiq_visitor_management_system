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
        'B_id',
        'name',
        'phone',
        'reason',
        'blacklisted_at',
        'national_id',  // Add 'national_id' to fillable fields
    ];

    // Define date attributes
    protected $dates = ['blacklisted_at'];

    // Add a scope to search blacklisted visitors
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")
                     ->orWhere('phone', 'LIKE', "%{$term}%")
                     ->orWhere('national_id', 'LIKE', "%{$term}%");  // Include search on 'national_id'
    }

    // Accessor to format the date
    public function getBlacklistedAtFormattedAttribute()
    {
        return $this->blacklisted_at ? $this->blacklisted_at->format('d-m-Y') : 'N/A';
    }
}
