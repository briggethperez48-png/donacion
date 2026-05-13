<!-- php artisan serve --host=0.0.0.0 --port=8080 -->
<section class="menu">
        <div>
            <nav class="nav navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">UwU</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="li nav-item">
                            <a href="{{url('/content/')}}" class="a">Inicio</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/donador/create')}}" class="a">Registro de Donante</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/register')}}" class="a">Registro de Usuario</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/donador')}}" class="a">Gestión de Donantes</a>
                        </li>
                        <!-- <li class="li nav-item">
                            <a href="{{url('/')}}" class="a">Gestión de Usuarios</a>
                        </li> -->
                        <li class="li nav-item">
                            <a href="{{url('/content/estadisticas')}}" class="a">Estadísticas</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/content/buscador')}}" class="a">Buscador</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/content/reporte')}}" class="a">Reporte</a>
                        </li>
                        <li class="li nav-item">
                            <a href="{{url('/')}}" class="a">Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>