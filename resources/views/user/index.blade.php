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

               <h2>Listado de Usuarios</h2><br/>
              
                <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar usuario
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        {!! Form::open(array('url'=>'usuario','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
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
                           
                            <th>Nombre</th>
                            <th>Tipo Documento</th>
                            <th>Número</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $user)
                        <tr>
                            
                            <td>{{$user->nombre}}</td>
                            <td>{{$user->tipo_documento}}</td>
                            <td>{{$user->num_documento}}</td>
                            <td>{{$user->direccion}}</td>
                            <td>{{$user->telefono}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->usuario}}</td>
                            <td>{{$user->rol}}</td>
                            <td>
                                <img src="{{asset('storage/img/usuario/'.$user->imagen)}}" 
                                id="imagen1" alt ="{{$user->nombre}}" class="img-responsive"
                                width="100px" height="100px">
                            </td>
                            <td>
                                @if ($user->condicion == "1")
                                    
                                    <button type="button" class="btn btn-success btn-md">
                                    
                                      <i class="fa fa-check fa-2x"></i> Activo
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-md">
                                    
                                    <i class="fa fa-times fa-2x"></i> Desactivado
                                    </button>
                                @endif
                            </td>

                            <td>
                                <button type="button" class="btn btn-info btn-md"
                                    data-id_usuario="{{$user->id}}"
                                    data-nombre="{{$user->nombre}}"
                                    data-tipo_documento="{{$user->tipo_documento}}"
                                    data-num_documento="{{$user->num_documento}}"
                                    data-direccion="{{$user->direccion}}"
                                    data-telefono="{{$user->telefono}}"
                                    data-email="{{$user->email}}"
                                    data-usuario="{{$user->usuario}}"
                                    data-id_rol="{{$user->idrol}}"
                                    data-imagen="{{$user->imagen}}"
                                    data-toggle="modal" data-target="#abrirmodalEditar">

                                  <i class="fa fa-edit fa-2x"></i> Editar
                                </button> &nbsp;
                            </td>

                            <td>
                                @if ($user->condicion)
                                    <button type="button" class="btn btn-danger btn-sm"
                                    data-id_usuario="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                        <i class="fa fa-times fa-2x"></i> Desactivar
                                    </button>
                                @else
                                    <button type="button" class="btn btn-success btn-sm"
                                    data-id_usuario="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                        <i class="fa fa-lock fa-2x"></i> Activar
                                    </button>
                                @endif
                                
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                {{$usuarios->render()}}
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar-->
    <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('usuario.store')}}" method="post"  class="form-horizontal" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('user.form')
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
                    <h4 class="modal-title">Actualizar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('usuario.update','test')}}" method="post"  class="form-horizontal" enctype="multipart/form-data">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <input type="hidden" name="id_usuario" id="id_usuario" value="">
                        @include('user.form')
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
                    <h4 class="modal-title">Cambiar estado del usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                                        
                    <form action="{{route('usuario.destroy','test')}}" method="post"  class="form-horizontal">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <input type="hidden" name="id_usuario" id="id_usuario" value="">
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