<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        // Laravel recomienda que cuando tengas mas de 3 reglas de validación, es 
        // recomendable colocarlos en array
        // Una de las reglas de validación es 'in:(valor_establecido)' y de esa manera
        // se obliga a que debe ser una de los valores listados dentro del in
        $this->validate($request, [
            'username' => ['required','unique:users,username,' . auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
            'email_new' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60'],
        ]);

        if(!Hash::check($request->password, auth()->user()->password)){
            // Te redirecciona a la pagina anterior, pero con un mensaje
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        if($request->imagen){

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen); // Crear img con intervetion img , importamos la clase con facade
            $imagenServidor->fit(1000, 1000, null, 'center');

            $imagenPath = public_path('profile_pics') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email_new;
        $usuario->password = $request->password_new ? Hash::make($request->password_new) : auth()->user()->password;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}
