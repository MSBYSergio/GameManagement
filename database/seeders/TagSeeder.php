<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Acción' => '#FF5733',
            'Aventura' => '#FFD700',
            'RPG' => '#8A2BE2',
            'Estrategia' => '#4682B4',
            'Shooter' => '#DC143C',
            'Deportes' => '#008000',
            'Carreras' => '#FF4500',
            'Horror' => '#000000',
            'Plataformas' => '#32CD32',
            'Puzzle' => '#1E90FF',
            'Simulación' => '#808080',
            'Mundo Abierto' => '#20B2AA'
        ];
        
        foreach ($tags as $name => $color) {
            Tag::create(compact('name', 'color'));
        }
    }
}
