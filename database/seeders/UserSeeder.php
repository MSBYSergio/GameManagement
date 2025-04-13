<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $games = Game::pluck('id')->toArray();

        foreach ($users as $item) {
            shuffle($games);
            $item->games()->attach($this->getGames($games));
        }
    }

    public function getGames($games)
    {
        return array_slice($games, 0, random_int(1, count($games) - 1));
    }
}
