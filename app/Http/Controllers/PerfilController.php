<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store( Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);

        $request->validate([
            // 'username'=>['required','unique:users,username, {auth()->user()->id}', 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore(Auth::user()),
                'min:3',
                'max:20',
                'not_in:twitter,editar-perfil'
            ]
        ]);

        if($request->imagen) {
            $manager = new ImageManager(new Driver());
            $imagen = $request->file('imatge');
            $nomImatge = Str::uuid().".".$imagen->extension();


            $imatgeServidor = $manager->read($imagen);
            $imatgeServidor->scale(1000, 1000);
            $imagenPath = public_path('perfils').'/'.$nomImatge;
            $imatgeServidor->save($imagenPath);

        }

        // Desar canvis
        $usuari = User::find(Auth::user()->id);
        $usuari->username = $request->username;
        $usuari->imatge = $nomImatge ?? '';
        $usuari->save();

        return redirect()->route('posts.index', $usuari->username);
    }
}


