@extends('principal')
@section('contenido')

<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">BACKEND - SISTEMA DE COMPRAS - VENTAS</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">

                <h2>Listado de Compras</h2><br/>
                <a href="compra/create"> 
                <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Categoría
                </button>
                </a>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        {!! Form::open(array('url'=>'compra','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                            <div class="input-group">
                                <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar Texto" value="{{$buscarTexto}}">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Buscar </button>
                            </div> 
                        {{Form::close()}}
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr class="bg-primary">
                           
                            <th>Ver Detalle</th>
                            <th>Fecha Compra</th>
                            <th>Número Compra</th>
                            <th>Proveedor</th>
                            <th>Tipo Identificación</th>
                            <th>Comprador</th>
                            <th>Total (USD$)</th>
                            <th>Impuesto</th>
                            <th>Estado</th>
                            <th>Cambiar Estado</th>
                            <th>Reporte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $comp)
                        <tr>
                            
                            <td>
                                <a href="{{URL::action('CompraController@show',$comp->id)}}">
                                    <button type="button" class="btn btn-warning btn-sm">
                                        <i class="fa fa-eye fa-2x"></i> Ver detalle
                                    </button> &nbsp;
                                </a>
                            </td>
                            <td>{{$comp->fecha_compra}}</td>
                            <td>{{$comp->num_compra}}</td>
                            <td>{{$comp->proveedor}}</td>
                            <td>{{$comp->tipo_identificacion}}</td>
                            <td>{{$comp->nombre}}</td>
                            <td>${{number_format($comp->total,2)}}</td>
                            <td>{{$comp->impuesto}}</td>
                            <td>
                                @if ($comp->estado == "Registrado")
                                    
                                    <button type="button" class="btn btn-success btn-md">
                                    
                                        <i class="fa fa-check fa-2x"></i> Registrado
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-md">
                                    
                                    <i class="fa fa-times fa-2x"></i> Anulado
                                    </button>
                                @endif
                            </td>

                            
                            <td>
                                @if ($comp->estado=="Registrado")
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-id_compra="{{$comp->id}}" data-togle="modal"
                                        data-target="#CambiarEstadoCompra">
                                        <i class="fa fa-times fa-2x"></i> Anular Compra
                                    </button>
                                @else
                                    <button type="button" class="btn btn-success btn-sm"
                                        <i class="fa fa-lock fa-2x"></i> Anulado
                                    </button>
                                @endif
                                
                               
                            </td>
                            <td>
                                <a href="{{url('pdfCompra',$comp->id)}}" target="_blank">
                                    <button type="button" class="btn btn-info btn-md">
                                        <i class="fa fa-file fa-2x"></i>PDF
                                    </button> &nbsp;
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                {{$compras->render()}}
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar-->
    <div class="modal fade" id="CambiarEstadoCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar Estado de compra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('compra.destroy','test')}}" method="POST" >
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <input type="hidden" name="id_compra" id="id_compra" value="">
                                <p>Estas seguro de cambiar el estado</p>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-danger" 
                            data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar </button>
                        </div>
                    </form>
                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal actualizar-->
    <!--Inicio del modal actualizar-->
    <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('categoria.update','test')}}" method="post"  class="form-horizontal">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <input type="hidden" name="id_categoria" id="id_categoria" value="">
                        @include('categoria.form')
                    </form>
                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        <!--Fin del modal actualizar-->

        <!--Inicio del modal cambiar estado-->
    <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar Estado de la categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('categoria.destroy','test')}}" method="post"  class="form-horizontal">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <input type="hidden" name="id_categoria" id="id_categoria" value="">
                        <p>Estas seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" 
                            data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar </button>
                        </div>
                    </form>
                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
</main>



@endsection