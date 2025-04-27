<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_opinion' => fake()->randomElement(['Recommended', 'Not Recommended']),
            'text' => fake()->text(85),
            'user_id' => User::all()->random()->id,
            'game_id' => Game::all()->random()->id,
        ];
    }
}
