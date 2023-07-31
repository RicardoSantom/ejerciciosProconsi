<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Agregar enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales para personalizar la apariencia */
        body {
            padding: 20px;
            background-color: #f0f0f0;
        }

        p {
            margin-bottom: 10px;
            color: #333;
        }

        a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 4px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<p>Ejercicios con cadenas</p>
<a href="{{ route('mostrarTexto') }}" class="btn btn-primary">Ver texto.blade.php</a>
<p>Ejercicios con fechas</p>
<a href="{{ route('fechas') }}" class="btn btn-primary">Ver fechas.blade.php</a>
<!-- Agregar enlaces a los archivos JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

