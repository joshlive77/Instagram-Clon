<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;

class UserController extends Controller
{
    // con esto evitamos que entren a los controladores
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($search = null){
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('surname', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('user.index',[
            'users' => $users
        ]);
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        // conseguir usuario identificado
        $user = \Auth::user();

        $id = $user->id;

        // validacion del formulario
        // 'unique:users,nick,'.$id comprueba automaticamente si el nicj ya existe para otro usuario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);

        // recoger datos del formulacio
        $email = $request->input('email');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');

        // asignar nuevos valores
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // subir la imagen
        $image_path = $request->file('image_path');
        if($image_path){
            // poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();
            // guarda en la carpera storage/app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // setear el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        // ejecutar consulta y cambios en la db
        $user->update();

        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);
        return view('user.profile', [
            'user' => $user
        ]);
    }

}
