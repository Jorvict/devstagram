<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Desde el momento que definimos la variable aquí ya se encuentra disponible en la vista
    // No es necesario pasarlo como argumento en la vista
    // public $mensaje = "Hola mundo desde atributo en clase de livewire";
    // public $mensaje;
    public $post;
    public $isLiked;
    public $likes;

    // Mount es una funcion que se ejecuta automaticamente cuando sea instanciado este componente LikePost
    // Basicamente es similar al constructor, la instancia es cuando se crea en la vista del blade
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }


    public function render()
    {
        return view('livewire.like-post');
    }

    public function like()
    {
        if($this->post->checkLike(auth()->user() )){
            
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else{

            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }
}
