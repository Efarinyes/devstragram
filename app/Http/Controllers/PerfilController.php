<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore(Auth::user()),
                'min:6'
            ],
            'oldpassword'=> ['required']
        ]);

        if(!Hash::check($request->oldpassword, Auth::user()->password)) {
            return back()->withErrors(['oldpassword', 'Contrassenya incorrecta'])->withInput();
        }

        if($request->filled('password')) {
            $request->validate([
                'password'=> ['required', 'confirmed', 'min:6']
            ]);
        }

        if($request->imatge) {
            $manager = new ImageManager(new Driver());
            $imagen = $request->file('imatge');
            $nomImatge = Str::uuid().".".$imagen->extension();


            $imatgeServidor = $manager->read($imagen);
            $imatgeServidor->cover(1000, 1000);
            $imagenPath = public_path('perfils').'/'.$nomImatge;
            $imatgeServidor->save($imagenPath);
        }

        // Desar canvis
        $usuari = User::find(Auth::user()->id);
        $usuari->username = $request->username;
        $usuari->imatge = $nomImatge ?? Auth::user()->imatge ?? '';
        $usuari->password = Hash::make($request->password);
        $usuari->email = $request->email;
        $usuari->save();

        return redirect()->route('posts.index', $usuari->username);
    }
}


