<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = ['image', 'name', 'price', 'description', 'release_date', 'developer', 'requirements'];

    // Relaciones

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class); // Muchos juegos son comprados por usuarios
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class); // Un juego tiene muchos comentarios (que pueden tener likes y dislikes)
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class); // Muchos juegos pueden tener muchas etiquetas
    }
}
