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
                        <a class="nav-link" href="#"><i class="fa fa-suitcase"></i> Ventas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('cliente')}}" onclick="event.preventDefault();
                        document.getElementById('cliente-form').submit();"><i class="fa fa-list"></i> Cliente</a>
                        <form id="cliente-form" action="{{url('cliente')}}" method="GET" style="display: none;">
                        {{csrf_field()}}
                        </form>
                    </li>
                   
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>