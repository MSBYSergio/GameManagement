<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name','color'];

    // Relaciones

    public function games(): BelongsToMany {
        return $this -> belongsToMany(Game::class); // Muchas etiquetas pertenecen a muchos juegos
    }

}
