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
    // LA LISTA DE PRODUCTO 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $productos = DB::table('productos as p')
            ->join('categorias as c', 'p.idcategoria','=','c.id')
            ->select('p.id','p.idcategoria','p.codigo','p.nombre','p.precio_venta','p.stock','imagen','p.condicion','c.nombre as Categoria')
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

    // STOER ES UNA FUNCION PARA GUARDAR UNA NUEVA PRODUCTO
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto -> idcategoria = $request->id;
        $producto -> codigo = $request->codigo;
        $producto -> nombre = $request->nombre;
        $producto -> precio_venta = $request->precio_venta;
        $producto -> stock = '0';
        $producto -> condicion = '1';

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
            $path = $request->file('imagen')->storeAs('public/img/producto',$filenameToStore);
        }else {
            $filenameToStore = "noimagen.jpg";
        }
        $producto -> imagen = $filenameToStore;
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

        if ($request->hasFile('imagen')) {

            /* si la imagen que subes es distinta a la que esta por defecto
            entonces eliminaria la imagen anterior, eso es para evitar 
            acumular imagenes en el servidor */
            if ($producto->imagen != 'noimagen.jpg') {
                Storage::delete('public/img/producto',$producto->imagen);
            } 
            
            //obtener el nombre de archivo con la extencion
            $filenamewidthExt = $request->file('imagen')->getClientOriginalName();

            // Obtener solo nombre de archivo
            $filename = pathinfo($filenamewidthExt, PATHINFO_FILENAME);

            // Obtener solo extencion del archivo
            $extension =  $request->file('imagen')->guessClientExtension();

            // Nombre del archivo para almacenar 
            $filenameToStore = time().'.'.$extension;

            // Cargar la imagen 
            $path = $request->file('imagen')->storeAs('public/img/producto',$filenameToStore);
        }else {
            $filenameToStore = $producto->imagen;
        }
        $producto -> imagen = $filenameToStore;
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
