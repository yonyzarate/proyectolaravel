<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Compras-Ventas con Laravel y Vue Js- webtraining-it.com">
    <meta name="keyword" content="Sistema Compras-Ventas con Laravel y Vue Js">
    <title>Proyecto</title>
    <!-- Icons -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button> 
        <!--PONER LOGO-->
        <!--<a class="navbar-brand" href="#"></a>-->
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Dashbord</a>
            </li>
           
        </ul>
        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('storage/img/usuario/'.Auth::user()->imagen)}}" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="{{route('logout')}}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                      {{csrf_field()}}
                    </form>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">

    @if(Auth::check())
        @if(Auth::user()->idrol == 1)
            @include('plantilla.sidebaradministrador')
        @elseif(Auth::user()->idrol == 2)
            @include('plantilla.sidebarvendedor')    
        @elseif(Auth::user()->idrol == 3)
            @include('plantilla.sidebarcomprador')
        @else 
        @endif
    @endif   
        <!-- Contenido Principal -->
    @yield("contenido")
        <!-- /Fin del contenido principal -->
    </div>   

    <footer class="app-footer">
        <span><a href="#">sistema-ventas-laravel</a> &copy; 2022</span>
        <span class="ml-auto">Desarrollado por yony zarate Paco <a href="https://yonyzarate.github.io/Portafolio-cv/">https://yonyzarate.github.io/Portafolio-cv/</a></span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    <script>
        // Editar categoria en venta modal
        $('#abrirmodalEditar').on('show.bs.modal',function(event){
        //  console.log('modal abierto');   
        var button = $(event.relatedTarget)
        var nombre_modal_editar = button.data('nombre')
        var descripcion_modal_editar = button.data('descripcion')
        var id_categoria = button.data('id_categoria')
        var modal = $(this)

        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #descripcion').val(descripcion_modal_editar);
        modal.find('.modal-body #id_categoria').val(id_categoria);
        }) 

        // INICIO ventana modal para cambiar estado de la Categoria 
        $('#cambiarEstado').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id_categoria = button.data('id_categoria')
            var modal = $(this)

            modal.find('.modal-body #id_categoria').val(id_categoria);
        })
        // FIN ventana modal para cambiar estado de la Categoria

        // Editar producto en venta modal
        $('#abrirmodalEditar').on('show.bs.modal',function(event){
        //  console.log('modal abierto');   
        // el button.data es lo que está en el button de editar 
        var button = $(event.relatedTarget)
        //  este id_categoria_modal_editar selecciona la categoria
        var id_categoria_modal_editar = button.data('id_categoria')
        var codigo_modal_editar = button.data('codigo')
        var nombre_modal_editar = button.data('nombre')
        var precio_venta_modal_editar = button.data('precio_venta')
        var stock_venta_modal_editar = button.data('stock')
        var id_producto = button.data('id_producto')
        var modal = $(this)

        // los # son los id que se encuentran en el formulario 
        modal.find('.modal-body #id').val(id_categoria_modal_editar);
        modal.find('.modal-body #codigo').val(codigo_modal_editar);
        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #precio_venta').val(precio_venta_modal_editar);
        modal.find('.modal-body #stock').val(stock_venta_modal_editar);
        modal.find('.modal-body #id_producto').val(id_producto);
        }) 

        
        // INICIO ventana modal para cambiar estado de la producto 
        $('#cambiarEstado').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id_producto = button.data('id_producto')
            var modal = $(this)

            modal.find('.modal-body #id_producto').val(id_producto);
        })
        // FIN ventana modal para cambiar estado de la producto


         // Editar proveedor en venta modal
         $('#abrirmodalEditar').on('show.bs.modal',function(event){
        //  console.log('modal abierto');   
        // el button.data es lo que está en el button de editar 
        var button = $(event.relatedTarget)
       
        var nombre_modal_editar = button.data('nombre')
        var tipo_documento_modal_editar = button.data('tipo_documento')
        var num_documento_modal_editar = button.data('num_documento')
        var direccion_modal_editar = button.data('direccion')
        var telefono_modal_editar = button.data('telefono')
        var email_modal_editar = button.data('email')
        var id_proveedor = button.data('id_proveedor')
        var modal = $(this)

        // los # son los id que se encuentran en el formulario 
        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
        modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
        modal.find('.modal-body #direccion').val(direccion_modal_editar);
        modal.find('.modal-body #telefono').val(telefono_modal_editar);
        modal.find('.modal-body #email').val(email_modal_editar);
        modal.find('.modal-body #id_proveedor').val(id_proveedor);
        }) 

         // Editar cliente en venta modal
         $('#abrirmodalEditar').on('show.bs.modal',function(event){
        //  console.log('modal abierto');   
        // el button.data es lo que está en el button de editar 
        var button = $(event.relatedTarget)
       
        var nombre_modal_editar = button.data('nombre')
        var tipo_documento_modal_editar = button.data('tipo_documento')
        var num_documento_modal_editar = button.data('num_documento')
        var direccion_modal_editar = button.data('direccion')
        var telefono_modal_editar = button.data('telefono')
        var email_modal_editar = button.data('email')
        var id_cliente = button.data('id_cliente')
        var modal = $(this)

        // los # son los id que se encuentran en el formulario 
        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
        modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
        modal.find('.modal-body #direccion').val(direccion_modal_editar);
        modal.find('.modal-body #telefono').val(telefono_modal_editar);
        modal.find('.modal-body #email').val(email_modal_editar);
        modal.find('.modal-body #id_cliente').val(id_cliente);
        }) 

         // Editar usuario en venta modal
         $('#abrirmodalEditar').on('show.bs.modal',function(event){
        //  console.log('modal abierto');   
        // el button.data es lo que está en el button de editar 
        var button = $(event.relatedTarget)
       
        var nombre_modal_editar = button.data('nombre')
        var tipo_documento_modal_editar = button.data('tipo_documento')
        var num_documento_modal_editar = button.data('num_documento')
        var direccion_modal_editar = button.data('direccion')
        var telefono_modal_editar = button.data('telefono')
        var email_modal_editar = button.data('email')
        // este id_rol_modal_editar selecciona la categoria 
        var id_rol_modal_editar = button.data('id_rol')
        var usuario_modal_editar = button.data('usuario')
        var id_usuario = button.data('id_usuario')
        var modal = $(this)

        // los # son los id que se encuentran en el formulario 
        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
        modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
        modal.find('.modal-body #direccion').val(direccion_modal_editar);
        modal.find('.modal-body #telefono').val(telefono_modal_editar);
        modal.find('.modal-body #email').val(email_modal_editar);
        modal.find('.modal-body #id_rol').val(id_rol_modal_editar);
        modal.find('.modal-body #usuario').val(usuario_modal_editar);
        modal.find('.modal-body #id_usuario').val(id_usuario);
        }) 

          // INICIO ventana modal para cambiar estado del usuario 
          $('#cambiarEstado').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id_usuario = button.data('id_usuario')
            var modal = $(this)

            modal.find('.modal-body #id_usuario').val(id_usuario);
        })
        // Fin ventana modal para cambiar el estado de USUARIO

        $('#CambiarEstadoCompra').on('show.bs.modal',function(event){
            var button = $(event.relatedTarget)
            var id_compra = button.data('id_compra')
            var modal = $(this)

            modal.find('.modal-body #id_compra').val(id_compra);
        })

           // INICIO ventana modal para cambiar estado de la venta 
           $('#CambiarEstadoVenta').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id_venta = button.data('id_venta')
            var modal = $(this)

            modal.find('.modal-body #id_venta').val(id_venta);
        })
        // Fin ventana modal para cambiar el estado de la venta












        // ******************************** SCRIPS DE COMPRAS********************************
        $(document).ready(function(){
     
     $("#agregar").click(function(){

         agregar();
     });

  });

   var cont=0;
   total=0;
   subtotal=[];
   $("#guardar").hide();

     function agregar(){

          id_producto= $("#id_producto").val();
          producto= $("#id_producto option:selected").text();
          cantidad= $("#cantidad").val();
          precio_compra= $("#precio_compra").val();
          impuesto=20;
        
          
          if(id_producto !="" && cantidad!="" && cantidad>0 && precio_compra!=""){
            
             subtotal[cont]=cantidad*precio_compra;
             total= total+subtotal[cont];
             
             var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" id="precio_compra[]" name="precio_compra[]"  value="'+precio_compra+'"> </td>  <td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td>$'+subtotal[cont]+' </td></tr>';
             cont++;
             limpiar();
             totales();
            
             evaluar();
             $('#detalles').append(fila);
            
            }else{

               // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
               
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compras',
              
                })
            
            }
         
     }

    
     function limpiar(){
        
        $("#cantidad").val("");
        $("#precio_compra").val("");
        

     }

     function totales(){

        $("#total").html("USD$ " + total.toFixed(2));

        total_impuesto=total*impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html("USD$ " + total_impuesto.toFixed(2));
        $("#total_pagar_html").html("USD$ " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
        
     }



     function evaluar(){

         if(total>0){

           $("#guardar").show();

         } else{
              
           $("#guardar").hide();
         }
     }

     function eliminar(index){

        total=total-subtotal[index];
        total_impuesto= total*20/100;
        total_pagar_html = total + total_impuesto;
       
        $("#total").html("USD$" + total);
        $("#total_impuesto").html("USD$" + total_impuesto);
        $("#total_pagar_html").html("USD$" + total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));
       
        $("#fila" + index).remove();
        evaluar();
     }


    //******************************************SCRIPS DE VENTAS*********************
        
  $(document).ready(function(){
     
     $("#agregar1").click(function(){

         agregar1();
     });

  });

   var cont=0;
   total=0;
   subtotal=[];
   $("#guardar").hide();
   $("#id_producto").change(mostrarValores);


    function mostrarValores(){
        datosProducto = document.getElementById('id_producto').value.split('_');
        $("#precio_venta").val(datosProducto[2]);
        $("#stock").val(datosProducto[1]);
    }
    function agregar1(){

        datosProducto = document.getElementById('id_producto').value.split('_');
        id_producto = datosProducto[0];
        producto= $("#id_producto option:selected").text();
        cantidad= $("#cantidad").val();
        descuento= $("#descuento").val();
        precio_venta= $("#precio_venta").val();
        stock= $("#stock").val();
        impuesto=20;
        
          
        if(id_producto !="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!=""){
            
            if(parseInt(stock)>=parseInt(cantidad)){

                subtotal[cont]=(cantidad*precio_venta)-(cantidad*precio_venta*descuento/100);
                total= total+subtotal[cont];

                var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" id="precio_venta[]" name="precio_venta[]"  value="'+parseFloat(precio_venta).toFixed(2)+'"> </td>  <td><input type="number" name="descuento[]" value="'+parseFloat(descuento).toFixed(2)+'"> </td><td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td>$'+parseFloat(subtotal[cont]).toFixed(2)+' </td></tr>';
                cont++;
                limpiar();
                totales();
                
                evaluar();
                $('#detalles').append(fila);
            
            }else{

               // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
               
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'La cantidad a vender supera el stock',
              
                })
            
            }
        }else{
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la venta',
              
                })
        }
     }

    
     function limpiar(){
        
        $("#cantidad").val("");
        $("#descuento").val("0");
        $("#precio_venta").val("");
        

     }

     function totales(){

        $("#total").html("USD$ " + total.toFixed(2));

        total_impuesto=total*impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html("USD$ " + total_impuesto.toFixed(2));
        $("#total_pagar_html").html("USD$ " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
        
     }



     function evaluar(){

         if(total>0){

           $("#guardar").show();

         } else{
              
           $("#guardar").hide();
         }
     }

     function eliminar(index){

        total=total-subtotal[index];
        total_impuesto= total*20/100;
        total_pagar_html = total + total_impuesto;
       
        $("#total").html("USD$" + total);
        $("#total_impuesto").html("USD$" + total_impuesto);
        $("#total_pagar_html").html("USD$" + total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));
       
        $("#fila" + index).remove();
        evaluar();
     }


    </script>
</body>

</html>