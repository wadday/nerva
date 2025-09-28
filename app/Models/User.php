<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'banner',
        'bio',
        'location',
        'is_verified',
        'streamer_level',
        'is_live',
        'followers_count',
        'following_count',
        'gifts_received',
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
            'is_verified' => 'boolean',
            'is_live' => 'boolean',
            'streamer_level' => 'integer',
            'followers_count' => 'integer',
            'following_count' => 'integer',
            'gifts_received' => 'integer',
        ];
    }

    /**
     * @return HasMany<StreamLike, User>
     */
    public function streamLikes(): HasMany
    {
        return $this->hasMany(StreamLike::class);
    }

    /**
     * @return HasMany<StreamListener, User>
     */
    public function streamSessions(): HasMany
    {
        return $this->hasMany(StreamListener::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany<User, User>
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany<User, User>
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }
}
