@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    
    {{-- x- es para componentes en laravel, debemos pasarale el nombre de la vista --}}
    {{-- Si el componente es solamente un elemento que no recibe argumentos, puede cerrarse sobre si misma,
        sin embargo si el componente tiene slots para argumentos entonces debe haber una apertura y cierre del
        componente --}}
    {{-- Tener en cuenta que la sintaxis debe ser exacta, desde : hasta la asignación de la variable debe ir
        todo junto  --}}

    {{-- Recuerda que al crear 2 componentes se crean 2 archivos, la vista presentacion y el componente que es la funcionalidad --}}
    <x-listar-post :posts="$posts"/>


    {{-- <x-listar-post>
        <x-slot:titulo>
            Esto es un header
        </x-slot:titulo>
        
        Esto es un titulo
    </x-listar-post> --}}

    {{-- <x-listar-post>
        Más información
    </x-listar-post>

    <x-listar-post>
        Un poco más
    </x-listar-post> --}}
    
@endsection