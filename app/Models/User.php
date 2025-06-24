<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\GuardHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, GuardHelpers;

    /**
     * The guard associated with the model.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
        'profile_photo',
        'is_active',
        'branch_id',
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Branch relationship
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->user_type === 'super_admin' || $this->hasGuardRole('Super Admin');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return in_array($this->user_type, ['admin', 'super_admin']) || 
               $this->hasGuardRole('Admin') || 
               $this->hasGuardRole('Super Admin');
    }

    /**
     * Check if user is manager
     */
    public function isManager(): bool
    {
        return $this->user_type === 'manager' || $this->hasGuardRole('Manager');
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->user_type === 'staff' || $this->hasGuardRole('Staff');
    }

    /**
     * Get user's full permissions including role-based permissions
     */
    public function getAllUserPermissions(): array
    {
        return $this->getAllGuardPermissions()->pluck('name')->toArray();
    }    /**
     * Check if user can access admin panel
     */
    public function canAccessAdminPanel(): bool
    {
        return $this->hasGuardRole('Super Admin') || 
               $this->hasGuardRole('Admin') || 
               $this->hasGuardRole('Manager');
    }

    /**
     * Get user's role display name
     */
    public function getRoleDisplayName(): string
    {
        $roles = $this->getGuardRoles();
        
        if ($roles->isEmpty()) {
            return ucfirst($this->user_type ?? 'User');
        }
        
        return $roles->first()->name;
    }

    /**
     * Scope to get active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get users by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('user_type', $type);
    }

    /**
     * Scope to get users with specific role
     */
    public function scopeWithRole($query, string $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role)->where('guard_name', 'web');
        });
    }

    /**
     * Boot method to assign default role
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Assign default role based on user_type if no role is assigned
            if ($user->roles()->count() === 0) {
                $defaultRole = match($user->user_type) {
                    'super_admin' => 'Super Admin',
                    'admin' => 'Admin',
                    'manager' => 'Manager',
                    'staff' => 'Staff',
                    default => 'Staff'
                };
                
                $user->assignGuardRole($defaultRole);
            }
        });
    }
}
