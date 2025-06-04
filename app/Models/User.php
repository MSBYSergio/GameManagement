<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Billable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'country',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    // Relaciones del modelo User

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class); // Muchos usuarios compran muchos juegos
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class); // Un usuario escribe muchos comentarios (N)
    }

    public function daLikes(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comments_likes', 'user_id', 'comment_id'); // Muchos usuario da likes a muchos comentarios
    }

    public function daDislike(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comments_dislikes', 'user_id', 'comment_id'); // Muchos usuarios da dislikes a muchos comentarios
    }
}
