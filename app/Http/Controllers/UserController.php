<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// PARA USAR EL MODELO DE USER
use App\User;
// PARA REDIRECIONAR LAS RUTAS 
use Illuminate\Support\Facades\Redirect;
// PARA PODER SUBIR IMAGENES 
use Illuminate\Support\Facades\Storage;
// PARA PODER USER LA BASE DE DATOS DE USER
use DB;

class UserController extends Controller
{
    
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE USUARIOS 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $usuarios = DB::table('users as u')
            ->join('roles as r', 'u.idrol','=','r.id')
            ->select('u.id','u.nombre','u.tipo_documento','u.num_documento',
            'u.direccion','u.telefono','u.email','u.usuario','u.passwor',
            'u.condicion','u.idrol','u.imagen','r.nombre as rol')
            ->where('u.nombre','LIKE','%'.$sql.'%')
            ->orwhere('u.num_documento','LIKE','%'.$sql.'%')
            ->orderby('u.id','desc')
            ->paginate(3);
            
            /* listar las carateristicas en ventana modal*/
            $roles = DB::table('roles')
            ->select('id','nombre','descripcion')
            ->where('condicion','=','1')->get();

            // return $usuarios;
            return view('user.index',["usuarios"=>$usuarios,"roles"=>$roles,"buscarTexto"=>$sql]);
        }
    }
    
    // STOER ES UNA FUNCION PARA GUARDAR UN NUEVO USUARIO
    public function store(Request $request)
    {

        $user = new User();
        $user -> nombre = $request->nombre;
        $user -> tipo_documento = $request->tipo_documento;
        $user -> num_documento = $request->num_documento;
        $user -> direccion = $request->direccion;
        $user -> telefono = $request->telefono;
        $user -> email = $request->email;
        $user -> usuario = $request->usuario;
        $user -> passwor = bcrypt($request->usuario);
        $user -> condicion = '1';
        $user -> idrol = $request->id_rol;

        
        // Manejar la carga de archivos 
        if ($request->hasFile('imagen')) {
            
            //obtener el nombre de archivo con la extencion
            $filenamewidthExt = $request->file('imagen')->getClientOriginalName();

            // Obtener solo nombre de archivo
            $filename = pathinfo($filenamewidthExt, PATHINFO_FILENAME);

            // Obtener solo extencion del archivo
            $extension =  $request->file('imagen')->guessClientExtension();

            // Nombre del archivo para almacenar 
            $filenameToStore = time().'.'.$extension;

            // Cargar la imagen 
            $path = $request->file('imagen')->storeAs('public/img/usuario',$filenameToStore);
        }else {
            $filenameToStore = "noimagen.jpg";
        }
        $user -> imagen = $filenameToStore;
        $user -> save();
        return Redirect::to("usuario");
    }    

    // UPDATE ES PARA PODER ACTUALIZAR UN REGISTRO DE USUARIOS 
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id_usuario);
        $user -> nombre = $request->nombre;
        $user -> tipo_documento = $request->tipo_documento;
        $user -> num_documento = $request->num_documento;
        $user -> direccion = $request->direccion;
        $user -> telefono = $request->telefono;
        $user -> email = $request->email;
        $user -> usuario = $request->usuario;
        $user -> passwor = bcrypt($request->password);
        $user -> condicion = '1';
        $user -> idrol = $request->id_rol;

        if ($request->hasFile('imagen')) {

            /* si la imagen que subes es distinta a la que esta por defecto
            entonces eliminaria la imagen anterior, eso es para evitar 
            acumular imagenes en el servidor */
            if ($user->imagen != 'noimagen.jpg') {
                Storage::delete('public/img/usuario/',$user->imagen);
            } 
            
            //obtener el nombre de archivo con la extencion
            $filenamewidthExt = $request->file('imagen')->getClientOriginalName();

            // Obtener solo nombre de archivo
            $filename = pathinfo($filenamewidthExt, PATHINFO_FILENAME);

            // Obtener solo extencion del arc hivo
            $extension =  $request->file('imagen')->guessClientExtension();

            // Nombre del archivo para almacenar 
            $filenameToStore = time().'.'.$extension;

            // Cargar la imagen 
            $path = $request->file('imagen')->storeAs('public/img/usuario',$filenameToStore);
        }else {
            $filenameToStore = $user->imagen;
        }
        $user -> imagen = $filenameToStore;
        $user -> save();
        return Redirect::to("usuario");
    }

    // DESTROY ES PARA PODER CAMBIARS EL ESTADO DE UN REGISTRO 
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id_usuario);
        if ($user->condicion == "1") {
            
            $user->condicion ='0';
            $user-> save();
            return Redirect::to("usuario");
        }else{
            $user->condicion ='1';
            $user-> save();
            return Redirect::to("usuario");
        }
    }
}
