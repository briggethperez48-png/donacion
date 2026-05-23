<!-- php artisan serve --host=0.0.0.0 --port=8080 -->
@can('Components')
    <section class="menu" style="margin-top: 60px;">
        <div>
            <nav class="mx-2">
                <div class="" id="">
                    <ul class="">
                        @can('Dashboard')
                        <li class="">
                            <a href="{{url('/content/')}}" class="a btn">Inicio</a>
                        </li>
                        @endcan
                            <li class="">
                                <a href="{{url('/donador/create')}}" class="a btn">Registro de Donante</a>
                            </li>
                        @can('Users create')
                        <li class="">
                            <a href="{{url('/user/create')}}" class="a btn">Registro de Usuario</a>
                        </li>
                        @endcan
                        @can('Donador index')
                        <li class="">
                            <a href="{{url('/donador')}}" class="a btn">Gestión de Donantes</a>
                        </li>
                        @endcan
                        @can('Users index')
                        <li class="">
                            <a href="{{url('/user')}}" class="a btn">Gestión de Usuarios</a>
                        </li>
                        @endcan
                        @can('Estadisticas index')
                        <li class="">
                            <a href="{{url('/content/estadisticas')}}" class="a btn">Estadísticas</a>
                        </li>
                        @endcan
                        @can('Buscador index')
                        <li class="">
                            <a href="{{url('/content/buscador')}}" class="a btn">Buscador</a>
                        </li>
                        @endcan
                        @can('Reportes index')
                        <li class="">
                            <a href="{{url('/content/reporte')}}" class="a btn">Reporte</a>
                        </li>
                        @endcan
                        <li class="">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn a" style="display: inline; cursor: pointer;">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
@endcan