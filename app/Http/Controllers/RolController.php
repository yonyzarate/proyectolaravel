<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use DB;

class RolController extends Controller
{
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE ROLES 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $roles = DB::table('roles')->where('nombre','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(3);
            // return $roles;
            return view('rol.index',["roles"=>$roles,"buscarTexto"=>$sql]);
        }
    }
}
