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

               <h2>Listado de Categorías</h2><br/>
              
                <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Categoría
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        {!! Form::open(array('url'=>'categoria','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
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
                           
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $cat)
                        <tr>
                            
                            <td>{{$cat->nombre}}</td>
                            <td>{{$cat->descripcion}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-md">
                            
                                  <i class="fa fa-check fa-2x"></i> Activo
                                </button>
                               
                            </td>

                            <td>
                                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#abrirmodal">

                                  <i class="fa fa-edit fa-2x"></i> Editar
                                </button> &nbsp;
                            </td>

                            <td>

                                
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-lock fa-2x"></i> Desactivar
                                </button>
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                {{$categorias->render()}}
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('categoria.store')}}" method="post"  class="form-horizontal">
                        {{csrf_field()}}
                        @include('categoria.form')
                    </form>
                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
   
    
</main>



@endsection