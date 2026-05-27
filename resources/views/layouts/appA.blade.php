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

        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/web.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
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


    <!-- Footer -->
    @if(!Route::is('donador.create', 'donador.edit','login', 'login.post', 'logout'))
        <section>
            @include('components.footerGen')
        </section>

    @elseif(Route::is('login', 'login.post', 'logout'))
        <section></section>
    @else
            <section>
                @include('components.footerForm')
            </section>
    @endif
       
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('scripts')
</body>
</html>