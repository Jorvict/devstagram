<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Si vas a tener un controlador con un solo método es mas recomendable hacer un método de tipo invocable
    // Al tener invoke lo que sucede es este metodo se manda a llamar automaticamente, similar al constructor, y en el route ya no
    // será necesario pasarle el nombre del método
    public function __invoke()
    {

        // obtener a quienes seguimos, obteniendo especificamente los IDs de usuarios a los que seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view ('home', [
            'posts' => $posts
        ]);
    }
}
