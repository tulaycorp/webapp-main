<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    /**
     * The table associated with the model.
     * (Using 'sessions' which matches the existing schema)
     */
    protected $table = 'sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'session_token',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Indicates if the model should be timestamped.
     * (Only created_at exists in the schema, no updated_at)
     */
    public $timestamps = false;

    /**
     * Get the user that owns the session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the session is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Generate a new session token.
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Create a new session for a user.
     */
    public static function createForUser(User $user, int $daysValid = 30): self
    {
        return self::create([
            'user_id' => $user->id,
            'session_token' => self::generateToken(),
            'expires_at' => now()->addDays($daysValid),
        ]);
    }
}
