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
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Nou correu"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500
                        @enderror"
                        value="{{ auth()->user()->email }}"
                    />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contrassenya Actual
                    </label>
                    <input
                        id="oldpassword"
                        name="oldpassword"
                        type="password"
                        placeholder="Contrassenya actual"
                        class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500
                        @enderror"
                    />
                    @error('oldpassword')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nova Contrassenya
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Nova contrassenya"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500
                        @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Nova Contrassenya</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repeteix la contrassenya" class="border p-3 w-full rounded-lg">
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
