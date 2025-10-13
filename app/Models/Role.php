<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // Define many-to-many relationship with Permission model
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
