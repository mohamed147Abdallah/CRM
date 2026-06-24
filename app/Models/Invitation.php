<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Invitation Model for handling recruitment tokens.
 * Source Path: app/Models/Invitation.php
 */
class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'role',
        'accepted',
        'expires_at'
    ];

    /**
     * The attributes that should be cast.
     * This ensures that 'expires_at' is automatically converted 
     * from a string to a Carbon instance so we can use isFuture().
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'accepted' => 'boolean',
    ];

    /**
     * Logic: Automatically generate a secure unique token and set an expiry date.
     */
    protected static function booted()
    {
        static::creating(function ($invitation) {
            // Generate a secure 40-character random string for the token
            $invitation->token = Str::random(40);
            
            // Set the protocol to expire in 72 hours (3 days)
            $invitation->expires_at = now()->addDays(3);
        });
    }

    /**
     * Security Helper: Verifies if the invitation protocol is still operational.
     */
    public function isValid()
    {
        // Now that expires_at is cast to 'datetime', we can safely call isFuture()
        return !$this->accepted && $this->expires_at && $this->expires_at->isFuture();
    }
}