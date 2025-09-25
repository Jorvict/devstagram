@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ str_replace('username', 'Usuario', $message) }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email_new" class="mb-2 block uppercase text-gray-500 font-bold">Correo</label>
                    <input type="text" id="email_new" name="email_new" placeholder="Tu nuevo correo" class="border p-3 w-full rounded-lg @error('email_new') border-red-500 @enderror" value="{{ auth()->user()->email }}">
                    @error('email_new')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ str_replace('email new', 'Nuevo correo', $message) }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" id="imagen" name="imagen" class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg, .png">
                </div>

                <div class="mb-5">
                    <label for="password_new" class="mb-2 block text-gray-500 font-bold">Contraseña Nueva</label>
                    <input type="password" id="password_new" name="password_new" placeholder="Tu nueva contraseña" class="border p-3 w-full rounded-lg @error('password_new') border-red-500 @enderror">
                    @error('password_new')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ str_replace('password_new', 'Contraseña', $message) }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block text-gray-500 font-bold">Contraseña Actual</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese contraseña actual para aplicar cambios" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ str_replace('password', 'Contraseña', $message) }}</p>
                    @enderror
                </div>

                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p> 
                @endif

            </form>
        </div>
    </div>
@endsection