<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_1',
        'phone_2',
        'address',
        'age',
        'dob',
        'nid',
        'gender',
        'marital_status',
        'user_type', // Added role_id to mass assignable attributes
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define a relationship with the Role model.
     */
    public function userType()
    {
        return $this->belongsTo(Role::class, 'user_type'); // Updated foreign key
    }

    /**
     * Helper function to check if the user has a specific role.
     */
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Fetch all permissions of the user's role.
     */
    

    /**
     * Accessor for phone_1 with a default value.
     */
    public function getPhone1Attribute($value)
    {
        return $value ?? 'Not Provided';
    }

    /**
     * Get the profile picture URL or return a default image.
     */
    public function getProfilePictureUrl()
    {
        return $this->profile_picture
            ? asset('storage/' . $this->profile_picture)
            : asset('images/default-profile.png');
    }

    public function getProfileImageAttribute()
    {
        return $this->profile_picture // Change `profile_picture` to your database column name
            ? Storage::url($this->profile_picture) // For storage paths
            : asset('images/default-profile.png'); // Path to a default profile picture
    }

    
    public function allModules()
    {
        $modules = collect();

        // Get roles assigned to the user
        foreach ($this->roles as $role) {
            $modules = $modules->merge($role->permissions->pluck('module_name')->unique());
        }

        return $modules->unique();
    }

    // app/Models/User.php

    public function adminlte_image()
    {
        return $this->profile_picture // Change `profile_picture` to your database column name
        ? Storage::url($this->profile_picture) // For storage paths
        : asset('images/default-profile.png'); // Path to a default profile picture
    }
}
