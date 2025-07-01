<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_code',
        'branch_name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'email',
        'timezone',
        'manager_name',
        'is_main_branch',
        'is_active',
    ];

    protected $casts = [
        'is_main_branch' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Users belonging to this branch
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope: Get only active branches
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Generate unique branch code
     */
    public static function generateBranchCode(): string
    {
        $lastBranch = self::latest('id')->first();
        $lastId = $lastBranch ? (int) substr($lastBranch->branch_code, 2) : 0;
        return 'BR' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get the main branch
     */
    public static function getMainBranch()
    {
        return self::where('is_main_branch', true)->first();
    }
}
