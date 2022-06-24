<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\DetalleVenta;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class VentaController extends Controller
{
    // LA FUNCION INDEX TRABAJA PARA TRAER 
    // LA LISTA DE ventas 
    public function index(Request $request)
    {
        //
        if ($request) {
            $sql = trim($request->get('buscarTexto'));
            $ventas = DB::table('ventas as ve')
            ->join('clientes as cl', 'cl.id','=','ve.idcliente')
            ->join('users as us', 'us.id','=','ve.idusuario')
            ->join('detalle_ventas as dv', 've.id','=','dv.idventa')
            ->select('ve.id','ve.tipo_identificacion','ve.num_venta','ve.fecha_venta',
            've.impuesto','ve.estado','ve.total','cl.nombre as cliente','us.nombre')
            ->where('ve.num_venta','LIKE','%'.$sql.'%')
            ->orderby('ve.id','desc')
            ->groupBy('ve.id','ve.tipo_identificacion','ve.num_venta','ve.fecha_venta',
            've.impuesto','ve.estado','cl.nombre')
            ->paginate(8);
            
            // /* listar las carateristicas en ventana modal*/
            // $categorias = DB::table('categorias')
            // ->select('id','nombre','descripcion')
            // ->where('condicion','=','1')->get();

            // return $ventas;
            return view('venta.index',["ventas"=>$ventas,"buscarTexto"=>$sql]);
        }
    } 
    public function create(){

        // listar los proveedores en la ventana modal
        $clientes =DB::table('clientes')->get();

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
        ->orderby('co.id','desc')
        ->groupBy('co.id','co.tipo_identificacion','co.num_compra','co.fecha_compra',
        'co.impuesto','co.estado','pro.nombre')
        ->first();

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

    public function pdf(Request $request, $id){
        $compra = DB::table('compras as co')
        ->join('proveedores as pro','pro.id','=','co.idproveedor')
        ->join('users as us','us.id','=','co.idusuario')
        ->join('detalle_compras as dl','co.id','=','dl.idcompra')
        ->select('co.id','co.tipo_identificacion','co.num_compra','co.created_at',
        'co.impuesto',DB::raw('sum(dl.cantidad*precio) as total'),
        'co.estado','pro.nombre','pro.tipo_documento','pro.num_documento',
        'pro.direccion','pro.email','pro.telefono','us.usuario')
        ->where('co.id','=',$id)
        ->orderBy('co.id','desc')
        ->groupBy('co.id','co.tipo_identificacion','co.num_compra','co.created_at',
        'co.impuesto','co.estado','pro.nombre','pro.tipo_documento','pro.num_documento',
        'pro.direccion','pro.email','pro.telefono','us.usuario')
        ->take(1)->get();

        $detalles = DB::table('detalle_compras as dl')
        ->join('productos as prod','prod.id','=','dl.idproducto')
        ->select('dl.cantidad','dl.precio','prod.nombre as producto')
        ->where('dl.idcompra','=',$id)
        ->orderBy('dl.id','desc')->get();

        $numcompra =Compra::select('num_compra')->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.compra',['compra'=>$compra,'detalles'=>$detalles]);
        return $pdf->download('compra-'.$numcompra[0]->num_compra.'.pdf');
        
        

    }
}
