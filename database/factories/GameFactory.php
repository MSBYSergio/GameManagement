<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Juego>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));
        $price = fake()->randomFloat(2, 1, 80) * 1.21;
        $is_discount = fake()->boolean(65);
        $percent = random_int(10, 70);
        return [
            'image' => "images/games/" . fake()->picsum('public/storage/images/games/', 400, 400, false),
            'name' => fake()->unique()->sentence(3, true),
            'price' => $price,
            'description' => fake()->paragraph(5, false),
            'release_date' => fake()->dateTime(),
            'discount' => $is_discount,
            'discount_price' => $is_discount ? $price - ($price * ($percent / 100)) : null,
            'developer' => fake()->word(),
            'requirements' => fake()->text(25),
            'stripe_id' => null,
            'stripe_price_id' => null,
        ];
    }
}
