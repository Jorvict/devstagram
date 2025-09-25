<?php

namespace App\Http\Livewire;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class ComentarioPost extends Component
{
    public $comentario;
    public $post;
    public $user;

    public function mount(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.comentario-post', [
            'comentarios' => $this->post->comentarios()->latest()->get(),
        ]);
    }

    public function comentar()
    {
        $this->validate([
            'comentario' => 'required|max:255',
        ]);

        $this->post->comentarios()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario,
        ]);

        $this->comentario = '';

        session()->flash('mensaje', 'Comentario agregado correctamente');


    }


}
