<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/errors.css')}}">

    <title>@yield('title')</title>
</head>
<body class="align-content-center">
    <section class="error">
        <div class="position-relative mb-3">
            <img src="{{ asset('css/imagen/SEDESAB.png') }}" class="img-fluid" style="width: 20rem; height:auto;" alt="">
        </div>
        <div class="errorContent">
            <div class="errorIndex">
                <div class="svgAlert">
                    <svg  xmlns="http://www.w3.org/2000/svg" width="48" height="48"  
                        fill="currentColor" viewBox="2 2 20 20" >
                        <path d="M11 9h2v6h-2zm0 8h2v2h-2z"></path><path d="M12.87 2.51c-.35-.63-1.4-.63-1.75 0l-9.99 18c-.17.31-.17.69.01.99.18.31.51.49.86.49h20c.35 0 .68-.19.86-.49a1 1 0 0 0 .01-.99zM3.7 20 12 5.06 20.3 20z"></path>
                    </svg>
                </div>
                <div class="errorGen">
                    <h1>¡Auch!</h1>
                </div>
            </div>
            <div class="errorText">
                <div class="errorCode">
                    <h2>Error code: @yield('estado')</h2>
                </div>
                <div class="errorDesc">
                    <strong><span>@yield('desc')</span></strong>
                </div>
                <div class="errorInstruc">
                    <p><span>@yield('instruc')</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-right mt-3 mb-md-0">
            <a class="btn btnSc btn-lg px-5 shadow text-uppercase w-100 w-md-auto" href="{{route('content')}}">Inicio</a>
        </div>
    </section>
</body>
</html>