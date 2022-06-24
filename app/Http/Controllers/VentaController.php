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

        // listar los clientes en la ventana modal
        $clientes =DB::table('clientes')->get();

        // listar los productos en la ventana modal
        $productos =DB::table('productos as prod')
        ->join('detalle_compras as dc','prod.id','=','dc.idproducto')
        ->select(DB::raw('CONCAT(prod.codigo," ",prod.nombre) as producto'),'prod.id','prod.stock','prod.precio_venta')
        ->where('prod.condicion','=','1')
        ->where('prod.stock','>','0')
        ->groupBy('producto','prod.id','prod.stock')
        ->get();

        return view('venta.create',["clientes"=>$clientes,"productos"=>$productos]);
    }

    public function store(Request $request){

        try {
            DB:: beginTransaction();
            $mytime = Carbon::now('America/La_Paz');

            $venta = new Venta();
            $venta->idcliente = $request->id_cliente;
            $venta->idusuario = \Auth::user()->id;
            $venta->tipo_identificacion = $request->tipo_identificacion;
            $venta->num_venta = $request->num_venta;
            $venta->fecha_venta = $mytime->toDateString();
            $venta->impuesto = '0.20';
            $venta->total = $request->total_pagar;
            $venta->estado = 'Registrado';
            $venta->save();

            $id_producto = $request->id_producto;
            $cantidad = $request->cantidad;
            $precio = $request->precio_venta;
            $descuento = $request->descuento;



            // recorro todos los elementos de la
            $cont = 0;
            while($cont < count($id_producto)){
                $detalle = new DetalleVenta();
                // enviamos valores a los propiedades del objeto 
                // al idventa del objeto detalle le enviamos 
                $detalle->idventa = $venta->id;
                $detalle->idproducto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio = $precio[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->save();
                $cont++;
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
        }
        return Redirect::to('venta');
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
