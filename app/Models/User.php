<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_USER = 'USER';
    public const ROLE_EDITOR = 'EDITOR';
    public const ROLE_ADMIN = 'ADMIN';

    public const ROLES = [
        self::ROLE_USER,
        self::ROLE_EDITOR,
        self::ROLE_ADMIN,
    ];

    protected $attributes = [
        'role' => self::ROLE_USER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function hasEditorAccess(): bool
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function hasAdminAccess(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'user' => [
                'name' => $this->name,
                'role' => $this->role,
                'email' => $this->email,
            ]
        ];
    }

    /**
     * @return array<string>
     */
    public static function getRoles(): array
    {
        return self::ROLES;
    }
}
