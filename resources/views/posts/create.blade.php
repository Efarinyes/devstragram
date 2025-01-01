@extends('layouts.app')

@section('titol')
    Publica nou contingut
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contingut')
@vite('resources/js/app.js')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form
                action="{{ route('imagenes.store')}}"
                id="dropzone"
                method="POST"
                enctype="multipart/form-data"
                class="dropzone border-dashed border-2 ws-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action=" {{route('posts.store')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titol
                    </label>
                    <input
                        id="titol"
                        name="titol"
                        value="{{old('titol')}}"
                        type="text"
                        placeholder="El titol de la publicació"
                        class="border p-3 w-full rounded-lg @error('titol') border-red-500 @enderror"
                    />
                    @error('titol')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcio" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripció
                    </label>
                    <textarea
                        id="descripcio"
                        name="descripcio"
                        placeholder="Contingut de la publicació"
                        class="border p-3 w-full rounded-lg @error('descripcio') border-red-500 @enderror"
                    >{{old('name')}}</textarea>
                    @error('descripcio')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input
                        name="imatge"
                        type="hidden"
                        value="{{ old('imatge')}}"
                    >
                    @error('imatge')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}} </p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Publicar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"

                />
            </form>
        </div>
    </div>
@endsection

