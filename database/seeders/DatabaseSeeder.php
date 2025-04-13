<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('images/users');
        Storage::deleteDirectory('images/games');
        Storage::makeDirectory('images/users');
        Storage::makeDirectory('images/games');

        $this->call(TagSeeder::class); // Primero creo las etiquetas
        Game::factory(30)->create(); // Después creo los juegos
        $this->call(UserSeeder::class); // Creo los usuarios y les asigno juegos a su biblioteca

        Comment::factory(40)->create(); // Creo los comentarios
        $this -> call(CommentSeeder::class); // Por último, le asigno unos likes y dislikes
    }
}
