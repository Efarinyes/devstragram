@extends('layouts.app')

@section('titol')
    Registra't a DevsTagram
@endsection

@section('contingut')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img  src=" {{asset('img/registrar.jpg')}}" alt="Imatge de registre usuari" >
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action=" {{route('register')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nom
                    </label>
                    <input
                        id="name"
                        name="name"
                        value="{{old('name')}}"
                        type="text"
                        placeholder="El teu nom"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{str_replace('name', 'nom',  $message)}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Usuari
                    </label>
                    <input
                        id="username"
                        name="username"
                        value="{{old('username')}}"
                        type="text"
                        placeholder="El teu nom d'usuari"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{str_replace('username', 'usuari',  $message)}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        value="{{old('email')}}"
                        type="email"
                        placeholder="El teu correu"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{str_replace('email', 'correu',  $message)}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contrassenya
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="La teva contrassenya"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{str_replace('password', 'contrassenya',  $message)}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repeteix Contrassenya
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repeteix la contrassenya"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <input
                    type="submit"
                    value="Crear compte"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"

                />
            </form>
        </div>

    </div>
@endsection
