<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all('*');
        $comentarios = Comment::pluck('id')->toArray();

        foreach ($users as $item) {
            shuffle($comentarios);
            $item->daLikes()->attach($this->getComentarios($comentarios));
        }
        
        foreach ($users as $item) {
            shuffle($comentarios);
            $item->daDislike()->attach($this->getComentarios($comentarios));
        }
    }

    public function getComentarios(array $comentarios)
    {
        return array_slice($comentarios, 0, random_int(1, count($comentarios) - 1));
    }
}
