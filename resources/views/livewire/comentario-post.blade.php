<div class="shadow bg-white p-5 mb-5">
    
    @auth()
    
        <form wire:submit.prevent="comentar">
            <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

            @csrf
            <div class="mb-5">
                <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un Comentario</label>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>
                @endif
                <textarea   id="comentario" 
                            wire:model="comentario"
                            placeholder="Agrega un Comentario" 
                            class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                ></textarea>
                @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                Comentar
            </button>

            {{-- <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"> --}}

        </form>
    @endauth
                
    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">

        @if ($post->comentarios->count())
            @foreach ($comentarios as $comentario)
                <div class="p-5 border-x-gray-300 border-b">
                    {{-- La columna de la tabla se llama comentario --}}
                    <a href="{{route('posts.index', $comentario->user )}}" class="font-bold"> {{ $comentario->user->username }} </a>
                    <p>{{ $comentario->comentario }}</p>
                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>

                </div>
            @endforeach
        @else
            <p class="p-10 text-center">No hay comentarios aún</p>
        @endif
    </div>
</div>
