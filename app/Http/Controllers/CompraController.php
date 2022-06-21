<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
use Carbon\Carbon;
use App\Compra;
use App\DetalleCompra;
use Illuminate\Support\Facades\Redirect;

class CompraController extends Controller
{
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE COMPRAS 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $compras = DB::table('compras as co')
            ->join('proveedores as pro', 'pro.id','=','co.idproveedor')
            ->join('users as us', 'us.id','=','co.idusuario')
            ->join('detalle_compras as dc', 'co.id','=','dc.idcompra')
            ->select('co.id','co.tipo_identificacion','co.num_compra','co.fecha_compra',
            'co.impuesto','co.estado','co.total','pro.nombre as proveedor','us.nombre')
            ->where('co.num_compra','LIKE','%'.$sql.'%')
            ->orderby('co.id','desc')
            ->groupBy('co.id','co.tipo_identificacion','co.num_compra','co.fecha_compra',
            'co.impuesto','co.estado','co.total','pro.nombre','us.nombre')
            ->paginate(1);
            
            // /* listar las carateristicas en ventana modal*/
            // $categorias = DB::table('categorias')
            // ->select('id','nombre','descripcion')
            // ->where('condicion','=','1')->get();

            // return $compras;
            return view('compra.index',["compras"=>$compras,"buscarTexto"=>$sql]);
        }
    } 
    public function create(){

        // listar los proveedores en la ventana modal
        $proveedores =DB::table('proveedores')->get();

        // listar los productos en la ventana modal
        $productos =DB::table('productos as prod')
        ->select(DB::raw('CONCAT(prod.codigo," ",prod.nombre) as producto'),'prod.id')
        ->where('prod.condicion','=','1')->get();

        return view('compra.create',["proveedores"=>$proveedores,"productos"=>$productos]);
    }

    public function store(Request $request){

        try {
            DB:: beginTransaction();
            $mytime = Carbon::now('America/La_Paz');

            $compra = new Compra();
            $compra->idproveedor = $request->id_proveedor;
            $compra->idusuario = \Auth::user()->id;
            $compra->tipo_identificacion = $request->tipo_identificacion;
            $compra->num_compra = $request->num_compra;
            $compra->fecha_compra = $mytime->toDateString();
            $compra->impuesto = '0.20';
            $compra->total = $request->total_pagar;
            $compra->estado = 'Registrado';
            $compra->save();

            $id_producto = $request->id_producto;
            $cantidad = $request->cantidad;
            $precio = $request->precio_compra;



            // recorro todos los elementos de la
            $cont = 0;
            while($cont < count($id_producto)){
                $detalle = new DetalleCompra();
                // enviamos valores a los propiedades del objeto 
                // al idcompra del objeto detalle le enviamos 
                $detalle->idcompra = $compra->id;
                $detalle->idproducto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio = $precio[$cont];
                $detalle->save();
                $cont++;
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
        }
        return Redirect::to('compra');
    }

    public function show($id){



        $compra = DB::table('compras as co')
        ->join('proveedores as pro','pro.id','=','co.idproveedor')
        ->join('detalle_compras as dc','co.id','=','dc.idcompra')
        ->select('co.id','co.tipo_identificacion','co.num_compra','co.fecha_compra',
        'co.impuesto','co.estado',DB::raw('sum(dc.cantidad*precio) as total'),'pro.nombre')
        ->where('co.id','=',$id)
        ->orderby('co.id','desc')->first();

        // mostrar detalles de
        $detalles = DB::table('detalle_compras as dc')
        ->join('productos as prod','prod.id','=','dc.idproducto')
        ->select('dc.cantidad','dc.precio','prod.nombre as producto')
        ->where('dc.idcompra','=',$id)
        ->orderBy('dc.id','desc')->get();
        return view('compra.show',['compra'=>$compra,'detalles'=>$detalles]);
        
    }

    public function destroy(request $request){

        $compra = Compra:: findOrFail($request->id_compra);
        $compra-> estado = 'Anulado';
        $compra-> save();
        return Redirect::to('compra');

    }

}
