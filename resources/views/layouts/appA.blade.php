<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <style>
        form {
            text-transform: uppercase;
        }
        input {
            text-transform: uppercase;
        }
        textarea {
            text-transform: uppercase;
        }
        #MunicipioI, #LocalidadI {
            display: none;
        }
    </style>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/web.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="{{asset('css/formUser.css')}}">
    <link rel="stylesheet" href="{{asset('css/content.css')}}">

    <title>@yield('title')</title>
</head>
<body>
    
    <!-- Header & menu -->
    @if(!Route::is('donador.create', 'donador.edit', 'login', 'login.post', 'logout'))
        <section class="components">
            @include('components.headerGen')
            @include('components.nav')
        </section>
    @endif

    <!-- Content -->
    <div class="m-4 content">
        @yield('content')
    </div>

    <div class="modal fade" id="modalGraficaLugar" tabindex="-1" role="dialog" aria-labelledby="modalLugarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLugarLabel">Detalle de Órganos en: <span id="nombreLugar" class="font-weight-bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="position: relative; height:400px; width:100%">
                        <canvas id="graficaModalDynamic"></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Cerrar Ventana</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    @if(Route::is('login', 'login.post', 'logout'))
        <section>
           
        </section>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
</body>
</html>