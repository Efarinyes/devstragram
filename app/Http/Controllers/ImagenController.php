<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        $nomImatge = Str::uuid().".".$imagen->extension();

        $manager = new ImageManager(new Driver());
        $imatgeServidor = $manager::gd()->read($imagen);
        $imatgeServidor->cover(1000, 1000);
        $imagenPath = public_path('uploads').'/'.$nomImatge;
        $imatgeServidor->save($imagenPath);
        return response()->json(['imatge'=>$nomImatge]);
    }
}
