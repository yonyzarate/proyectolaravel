<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use DB;

class CategoriaControllers extends Controller
{
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE CARTEGORTIAS 
        public function index(Request $request)
        {
            //
            if ($request) {
                $sql = trim($request->get('buscarTexto'));
                $categorias = DB::table('categorias')->where('nombre','LIKE','%'.$sql.'%')
                ->orderBy('id','desc')
                ->paginate(3);
                // return $categorias;
                return view('categoria.index',["categorias"=>$categorias,"buscarTexto"=>$sql]);
            }
        }
    
    // STOER ES UNA FUNCION PARA GUARDAR UNA NUEVA CATEGORIA
        public function store(Request $request)
        {
            $categoria = new Categoria();
            $categoria -> nombre = $request->nombre;
            $categoria -> descripcion = $request->descripcion;
            $categoria -> condicion = '1';
            $categoria -> save();
            return Redirect::to("categoria");
        }
    // UPDATE ES PARA PODER ACTUALIZAR UN REGISTRO DE CATEGORIA 
        public function update(Request $request)
        {
            $categoria = Categoria::findOrFail($request->id_categoria);
            $categoria -> nombre = $request->nombre;
            $categoria -> descripcion = $request->descripcion;
            $categoria -> condicion = '1';
            $categoria -> save();
            return Redirect::to("categoria");
        }
    
    // DESTROY ES PARA PODER CAMBIARS EL ESTADO DE UN REGISTRO 
        public function destroy(Request $request)
        {
            $categoria = Categoria::findOrFail($request->id_categoria);
            if ($categoria->condicion == "1") {
                
                $categoria->condicion ='0';
                $categoria-> save();
                return Redirect::to("categoria");
            }else{
                $categoria->condicion ='1';
                $categoria-> save();
                return Redirect::to("categoria");
            }
        }
}
