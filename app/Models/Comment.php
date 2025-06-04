<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['user_opinion', 'text', 'user_id', 'game_id'];

    // Relaciones del modelo Comment

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Un commentario pertenece a un usuario (1)
    }

    public function recibeLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'comments_likes','comment_id','user_id'); // Un comentario recibe likes de muchos usuarios
    }

    public function recibeDisLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'comments_dislikes','comment_id','user_id'); // Un comentario recibe dislikes de muchos usuarios
    }
}
