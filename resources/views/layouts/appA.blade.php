<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/donantes/public/css/web.css">

    <title>@yield('title')</title>
</head>
<body>
    
    <div class="container">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="SEDESA">
            SEDESA © 2026
        </div>
        <div class="redes">
            <a href="https://www.facebook.com/SSaludCdMx/" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://x.com/SSaludCdMx" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="https://www.youtube.com/c/SSaludCdMxComunicacion" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <div class="priv">
            <a href="{{url('/content/avisoprivacidad')}}">
                Aviso de privacidad
            </a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>