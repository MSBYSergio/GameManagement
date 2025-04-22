<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use App\Models\Game;
use App\Models\Juego;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $juegos = Game::all();
        $tags = Tag::pluck('tags.id')->toArray();
        
        foreach ($juegos as $item) {
            shuffle($tags);
            $item->tags()->attach($this->getTags($tags));
        }
    }

    public function getTags(array $tags)
    {
        return array_slice($tags, 0, random_int(1, count($tags) - 1));
    }
}
