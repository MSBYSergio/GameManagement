<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function inicio()
    {
        $destacados = Game::select('games.id', 'image', 'name', 'description', DB::raw('count(comments_likes.comment_id) AS likes'))
            ->join('comments', 'games.id', '=', 'comments.game_id')
            ->join('comments_likes', 'comments.id', '=', 'comments_likes.comment_id')
            ->groupBy('games.id', 'games.image', 'games.name', 'games.description')
            ->orderBy('likes', 'desc')->take(3)->get();
        
        $ofertas = Game::select('image', 'name', 'price', 'discount_price')
            ->where('discount_price', '>', 0)
            ->orderBy('name')->take(3)->get();
            
        return view('inicio', compact('destacados', 'ofertas'));
    }
}
