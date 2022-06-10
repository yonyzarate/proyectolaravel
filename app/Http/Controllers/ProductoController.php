<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductoController extends Controller
{
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE CARTEGORTIAS 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $productos = DB::table('productos as p')
            ->join('categorias as c', 'p.idcategoria','=','c.id')
            ->select('p.id','p.idcategoria','p.codigo','p.nombre','p.precio_venta','p.stock','p.condicion','c.nombre as Categoria')
            ->where('p.nombre','LIKE','%'.$sql.'%')
            ->orwhere('p.codigo','LIKE','%'.$sql.'%')
            ->orderby('p.id','desc')
            ->paginate(3);
            
            /* listar las carateristicas en ventana modal*/
            $categorias = DB::table('categorias')
            ->select('id','nombre','descripcion')
            ->where('condicion','=','1')->get();

            // return $productos;
            return view('producto.index',["productos"=>$productos,"categorias"=>$categorias,"buscarTexto"=>$sql]);
        }
    } 

    // STOER ES UNA FUNCION PARA GUARDAR UNA NUEVA CATEGORIA
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto -> idcategoria = $request->id;
        $producto -> codigo = $request->codigo;
        $producto -> nombre = $request->nombre;
        $producto -> precio_venta = $request->precio_venta;
        $producto -> stock = '0';
        $producto -> condicion = '1';
        $producto -> save();
        return Redirect::to("producto");
    }
    // UPDATE ES PARA PODER ACTUALIZAR UN REGISTRO DE CATEGORIA 
    public function update(Request $request)
    {
        $producto = Producto::findOrFail($request->id_producto);
        $producto -> idcategoria = $request->id;
        $producto -> codigo = $request->codigo;
        $producto -> nombre = $request->nombre;
        $producto -> precio_venta = $request->precio_venta;
        $producto -> stock = '0';
        $producto -> condicion = '1';
        $producto -> save();
        return Redirect::to("producto");
    }

    // DESTROY ES PARA PODER CAMBIARS EL ESTADO DE UN REGISTRO 
    public function destroy(Request $request)
    {
        $producto = Producto::findOrFail($request->id_producto);
        if ($producto->condicion == "1") {
            
            $producto->condicion ='0';
            $producto-> save();
            return Redirect::to("producto");
        }else{
            $producto->condicion ='1';
            $producto-> save();
            return Redirect::to("producto");
        }
    }
}
