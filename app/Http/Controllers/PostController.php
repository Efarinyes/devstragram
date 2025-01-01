<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
// use Intervention\Image\Colors\Rgb\Channels\Red;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(4);

        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store( Request $request)
    {
        $request->validate([
            'titol' => ['required', 'max:255'],
            'descripcio' => ['required'],
            'imatge' => ['required']
        ]);

      /*   Post::create([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'imatge' => $request->imatge,
            'user_id' => Auth::user()->id
        ]); */

        // Un altre forma de registrar dades a la bbdd

       /*  $post = new Post;
        $post->titol = $request->titol;
        $post->descripcio = $request->descripcio;
        $post->imatge = $request->imatge;
        $post->user_id = Auth::user()->id;
        $post->save(); */

        // Una tercera forma de registrar dades a la bbdd amb la relació que li toca
        $request->user()->posts()->create([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'imatge' => $request->imatge,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('posts.index', Auth::user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);
        Gate::authorize('delete', $post);
        // Eliminar l'arxiu de la imatge
        $imatge_path = public_path('uploads/' . $post->imatge);
        if (File::exists($imatge_path)) {
            unlink($imatge_path);
        }

        $post->delete();
        return redirect()->route('posts.index', Auth::user()->username);
    }
}
