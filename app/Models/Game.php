<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = ['stripe_id', 'stripe_price_id', 'image', 'price', 'name', 'discount', 'discount_price', 'description', 'release_date', 'developer', 'requirements'];

    // Relaciones del modelo Game

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class); // Muchos juegos son comprados por usuarios
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class); // Un juego tiene muchos comentarios
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class); // Muchos juegos pueden tener muchas etiquetas
    }

    // Métodos 

    public function getArrayTags(): array
    {
        return $this->tags()->pluck('tags.id')->toArray();
    }
}
