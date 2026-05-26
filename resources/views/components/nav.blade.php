<!-- php artisan serve --host=0.0.0.0 --port=8080 -->
@can('Components')
    <section class="menu" style="margin-top: 60px;">
        <div>
            <nav class="sidebar">
                <header>
                    <div class="image-text">
                        <span class="image">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-vinyl" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0"/>
                                <path d="M9 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                        </span>
                        <div class="text header-text">
                            <span class="name">Donaciones</span>
                            <span class="profession">Control de Registros</span>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                    </svg>
                </header>
                <div class="menu-bar" id="">
                    <div class="menu">
                        <ul class="menu-links">
                            @can('Dashboard')
                            <li class="nav-link">
                                <a href="{{url('/content/')}}" class="a btn">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-house" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                                    </svg>
                                    <span class="text nav-text">Inicio</span>
                                </a>
                            </li>
                            @endcan
                                <li class="nav-link">
                                    <a href="{{url('/donador/create')}}" class="a btn">
                                        <span class="text nav-text">Registro de Donante</span>
                                    </a>
                                </li>
                            @can('Users create')
                            <li class="nav-link">
                                <a href="{{url('/user/create')}}" class="a btn">
                                    <span class="text nav-text">Registro de Usuario</span>
                                </a>
                            </li>
                            @endcan
                            @can('Donador index')
                            <li class="nav-link">
                                <a href="{{url('/donador')}}" class="a btn">
                                    <span class="text nav-text">Gestión de Donantes</span>
                                </a>
                            </li>
                            @endcan
                            @can('Users index')
                            <li class="nav-link">
                                <a href="{{url('/user')}}" class="a btn">
                                    <span class="text nav-text">Gestión de Usuarios</span>
                                </a>
                            </li>
                            @endcan
                            @can('Users novedades')
                            <li class="nav-link">
                                <a href="{{url('/content/novedades')}}" class="a btn">
                                    <span class="text nav-text">Historial de Movimientos</span>
                                </a>
                            </li>
                            @endcan
                            @can('Estadisticas index')
                            <li class="nav-link">
                                <a href="{{url('/content/estadisticas')}}" class="a btn">
                                    <span class="text nav-text">Estadísticas</span>
                                </a>
                            </li>
                            @endcan
                            @can('Buscador index')
                            <li class="nav-link">
                                <a href="{{url('/content/buscador')}}" class="a btn">
                                    <span class="text nav-text">Buscador</span>
                                </a>
                            </li>
                            @endcan
                            @can('Reportes index')
                            <li class="nav-link">
                                <a href="{{url('/content/reporte')}}" class="a btn">
                                    <span class="text nav-text">Reporte</span>
                                </a>
                            </li>
                            @endcan
                            <li class="nav-link">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn a" style="display: inline; cursor: pointer;">
                                        <span class="text nav-text">Cerrar Sesión</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
@endcan