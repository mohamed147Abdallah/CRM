<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status', // Required for the invitation protocol
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
     * The "booted" method of the model.
     * Security Logic: 
     * 1. Assign 'admin' role and 'active' status to the first user ever registered.
     * 2. Default others to 'guest' and 'pending' to prevent unauthorized roster entries.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            // Check if this is the first user in the system
            if (static::count() === 0) {
                $user->role = 'admin';
                $user->status = 'active';
            } else {
                // Ensure default role is 'guest' so they don't show up in the Agent list immediately
                $user->role = $user->role ?? 'guest';
                $user->status = $user->status ?? 'pending';
            }
        });
    }

    /**
     * Relationship: One agent/admin has many customers.
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Helper: Check if the user is an Administrator.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Helper: Check if the user is a Sales Agent.
     */
    public function isAgent()
    {
        return $this->role === 'agent';
    }

    /**
     * Helper: Check if the user has an active status.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}