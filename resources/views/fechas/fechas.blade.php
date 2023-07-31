<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fechas</title>
    <!-- Agregar enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales para personalizar la apariencia */
        body {
            padding: 20px;
            background-color: #f0f0f0;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-right: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-bottom: 10px;
            color: #444;
        }

        .alert {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<h1>Operaciones con Fechas</h1>
<?php
ini_set('date.timezone', 'Europe/Madrid');
echo "<p>La fechay hora locales son = " . date("d-m-Y H:i:s A") . "</p>";
?>
<form method="POST" action="{{ route('fechas.procesar') }}">
    @csrf
    <div class="form-group">
        <label>Fecha 1 (yyyy/MM/dd):</label>
        <input type="text" name="fecha1" value="{{ $fecha1 ?? old('fecha1') }}" class="form-control"
               title="El formato de la fecha debe ser yyyy/MM/dd" pattern="\d{4}/\d{2}/\d{2}">
        @if(Session::has('fecha1_error'))
            <div class="alert alert-danger">{{ Session::get('fecha1_error') }}</div>
        @endif
    </div>
    <div class="form-group">
        <label>Fecha 2 (yyyy/MM/dd):</label>
        <input type="text" name="fecha2" value="{{ $fecha2 ?? old('fecha2') }}" class="form-control"
               title="El formato de la fecha debe ser yyyy/MM/dd" pattern="\d{4}/\d{2}/\d{2}">
        @if(Session::has('fecha2_error'))
            <div class="alert alert-danger">{{ Session::get('fecha2_error') }}</div>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" name="accion" value="calcularDiferenciaDias" class="btn btn-primary">Calcular Diferencia de Días</button>
        <button type="submit" name="accion" value="calcularInicioFinAnio" class="btn btn-primary">Calcular Inicio y Fin de Año</button>
        <button type="submit" name="accion" value="calcularDiasAnio" class="btn btn-primary">Calcular Número de Días del Año</button>
        <button type="submit" name="accion" value="calcularNumeroSemana" class="btn btn-primary">Calcular Número de la Semana</button>
    </div>
</form>
@if($resultado && $accion)
    <!-- Mostrar el acción y resultado -->
    <div class="alert alert-success">Resultado de {{ $accion }}: {{ $resultado }}</div>

    <!-- Eliminar el resultado y la acción de la sesión para que no se muestren otra vez -->
    @php
        session()->forget('resultado');
        session()->forget('accion');
    @endphp
@endif
<a href="{{ route('index') }}" class="btn btn-secondary mt-3">Volver a Index</a>
</div>
<!-- Agregar enlaces a los archivos JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
