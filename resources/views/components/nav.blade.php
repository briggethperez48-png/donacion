<!-- php artisan serve --host=0.0.0.0 --port=8080 -->
    <section class="manu">
        <div>
            <nav class="m-2">
                <a class="" href="#">Ayuda</a>
                <button class="" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="" id="">
                    <ul class="">
                        @can('Dashboard')
                        <li class="">
                            <a href="{{url('/content/')}}" class="a">Inicio</a>
                        </li>
                        @endcan
                            <li class="">
                                <a href="{{url('/donador/create')}}" class="a">Registro de Donante</a>
                            </li>
                        @can('Users create')
                        <li class="">
                            <a href="{{url('/user/create')}}" class="a">Registro de Usuario</a>
                        </li>
                        @endcan
                        @can('Donador index')
                        <li class="">
                            <a href="{{url('/donador')}}" class="a">Gestión de Donantes</a>
                        </li>
                        @endcan
                        @can('Users index')
                        <li class="">
                            <a href="{{url('/user')}}" class="a">Gestión de Usuarios</a>
                        </li>
                        @endcan
                        @can('Estadisticas index')
                        <li class="">
                            <a href="{{url('/content/estadisticas')}}" class="a">Estadísticas</a>
                        </li>
                        @endcan
                        @can('Buscador index')
                        <li class="">
                            <a href="{{url('/content/buscador')}}" class="a">Buscador</a>
                        </li>
                        @endcan
                        @can('Reportes index')
                        <li class="">
                            <a href="{{url('/content/reporte')}}" class="a">Reporte</a>
                        </li>
                        @endcan
                        <li class="">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>