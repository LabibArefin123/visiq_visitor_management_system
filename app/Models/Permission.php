<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'is_active']; // Include 'is_active' in fillable

    // Define many-to-many relationship with Role model
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Accessor to check if the permission is active
    public function isActive()
    {
        return $this->is_active;
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }
}
