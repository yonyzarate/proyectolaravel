<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('home')}}" onclick="event.preventDefault();
                        document.getElementById('home-form').submit();"><i class="fa fa-list"></i> Dashbord</a>
                        <form id="home-form" action="{{url('home')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>

                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('categoria')}}" onclick="event.preventDefault();
                        document.getElementById('categoria-form').submit();"><i class="fa fa-list"></i> Categorías</a>
                        <form id="categoria-form" action="{{url('categoria')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('producto')}}" onclick="event.preventDefault();
                        document.getElementById('producto-form').submit();"><i class="fa fa-list"></i> Productos</a>
                        <form id="producto-form" action="{{url('producto')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Compras</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('proveedor')}}" onclick="event.preventDefault();
                        document.getElementById('proveedor-form').submit();"><i class="fa fa-list"></i> Proveedor</a>
                        <form id="proveedor-form" action="{{url('proveedor')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-suitcase"></i> Ventas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('cliente')}}" onclick="event.preventDefault();
                        document.getElementById('cliente-form').submit();"><i class="fa fa-list"></i> Cliente</a>
                        <form id="cliente-form" action="{{url('cliente')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>
                        
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('usuario')}}" onclick="event.preventDefault();
                        document.getElementById('usuario-form').submit();"><i class="fa fa-user"></i> Usuarios</a>
                        <form id="usuario-form" action="{{url('usuario')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('rol')}}" onclick="event.preventDefault();
                        document.getElementById('rol-form').submit();"><i class="fa fa-list"></i> Roles</a>
                        <form id="rol-form" action="{{url('rol')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>
                        
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>