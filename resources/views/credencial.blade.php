<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Buena práctica para evitar desbordamientos */
        }
        
        body {
            overflow: hidden; /* Oculta barras de scroll en toda la página */
        }

        iframe {
            width: 100vw;
            height: 100vh;
            border: none; /* Elimina bordes */
            display: block; /* Quita el espacio extra inferior de los elementos en línea */
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial de Consentimiento</title>
</head>
<body>
    <iframe src="{{asset('documents/CredencialDonantes.pdf')}}" frameborder="0"></iframe>
</body>
</html>
