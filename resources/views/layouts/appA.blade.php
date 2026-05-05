<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/web.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>@yield('title')</title>
</head>
<body>
    
    @if(!Route::is('donador.create', 'donador.edit'))
        
        <section>
            
            @include('components.nav')
        </section>
    @endif

    <div class="m-4">
        @yield('content')
    </div>

    @if(!Route::is('donador.create', 'donador.edit'))
        <section>
            @include('components.footerGen')
        </section>
        @else
            <section>
                @include('components.footerForm')
            </section>
    @endif
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('scripts')
</body>
</html>