<?php

namespace App\Models;

use App\Traits\GuardHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, GuardHelpers;

    protected $guard_name = 'web';

    // Use integer primary key and username for authentication
    protected $primaryKey = 'id'; // Use integer ID as primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name', 'email', 'username', 'password', 'base_password',
        'user_type', 'phone', 'profile_photo', 'is_active', 'branch_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     * Keep this as username for login, but use ID for sessions
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Get the unique identifier for the user.
     * This will return the username for authentication
     */
    public function getAuthIdentifier()
    {
        return $this->username;
    }

    /**
     * Get the primary key for sessions (integer ID)
     */
    public function getKey()
    {
        return $this->getAttribute($this->getKeyName());
    }

    // Rest of your methods...
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function getAllUserPermissions(): array
    {
        return $this->getAllGuardPermissions()->pluck('name')->toArray();
    }

    public function getRoleDisplayName(): string
    {
        $roles = $this->getGuardRoles();
        
        if ($roles->isEmpty()) {
            return ucfirst($this->user_type ?? 'User');
        }
        
        return $roles->first()->name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithRole($query, string $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role)->where('guard_name', 'web');
        });
    }
}