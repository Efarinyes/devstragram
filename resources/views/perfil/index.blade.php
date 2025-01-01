@extends('layouts.app')

@section('titol')
    Editar perfil: {{ auth()->user()->username}}
@endsection

@section('contingut')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        value="{{auth()->user()->username}}"
                        type="text"
                        placeholder="El teu nom d'usuari"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{str_replace('username', 'nom usuari',  $message)}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imatge" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imatge de perfil
                    </label>
                    <input
                        id="imatge"
                        name="imatge"
                        value=""
                        type="file"
                        accept=".jpg, .jpeg, .png,"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <input
                    type="submit"
                    value="Guardar canvis"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>

        </div>
    </div>
@endsection
