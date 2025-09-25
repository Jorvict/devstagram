@extends('layouts.app')


@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">

                @auth
                    {{-- Se recomienda usar comillas dobles al pasar variables mediante livewire --}}
                    {{-- @php
                        $mensaje = "Hola mundo desde una variable";
                    @endphp --}}

                    <livewire:like-post :post="$post"/>


                    {{-- @if ($post->checkLike(auth()->user() ))
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">

                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif --}}

                    
                @endauth
                

                {{-- <p class="font-bold"> {{ $post->likes->count() }} <span class="font-normal"> Likes </span> </p> --}}
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>

            @auth
                @if($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{route('posts.destroy', $post)}}">
                        {{--}}  
                            Método spoofing, ya que el navegador nativamente solamente soporta GET y POST 
                            con método spoofing permite agregar otro tipo de peticiones como PUT, PATCH y DELETE
                        {{--}}
                        @method('DELETE')
                        @csrf
                        <input  type="submit"
                                value="Eliminar publicación"
                                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        />
                    </form>
                @endif
                
            @endauth

        </div>
        <div class="md:w-1/2 p-5">

            <livewire:comentario-post :post="$post" :user="$user" />
                
        </div>
    </div>
    
@endsection