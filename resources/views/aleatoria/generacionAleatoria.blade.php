<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <style>
        /* Estilos adicionales para personalizar la apariencia */
        body {
            padding: 20px;
            background-color: #f0f0f0;
        }

        h1, h2, h3 {
            margin-bottom: 10px;
            color: #333;
        }

        p, li {
            margin-bottom: 5px;
            color: #333;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Generación Aleatoria de Formas Geométricas</h1>
    <form method="POST" action="{{ route('generarFormas') }}">
        @csrf
        <label>Número de círculos:</label>
        <input type="number" name="num_circulos" required>
        <br>
        <label>Número de cuadrados:</label>
        <input type="number" name="num_cuadrados" required>
        <br>
        <label>Número de triángulos:</label>
        <input type="number" name="num_triangulos" required>
        <br>
        <button type="submit">Generar Formas Geométricas</button>
    </form>

    @if(isset($formas))
        <h2>Todas las Formas Geométricas (Aleatorio)</h2>
        <?php shuffle($formas); ?> <!-- Mezclar el array para obtener un orden aleatorio -->
        @foreach($formas as $forma)
            <p>Forma: {{ $forma['tipo'] }} | Área: {{ $forma['area'] }}</p>
            <ul>
                @foreach($forma['propiedades'] as $propiedad => $valor)
                    <li>{{ $propiedad }}: {{ $valor }}</li>
                @endforeach
            </ul>
        @endforeach
    @endif

    @if(isset($formasAgrupadas))
        <h2>Formas Geométricas Agrupadas</h2>
        @foreach($formasAgrupadas as $tipo => $formas)
            <h3>{{ $tipo }}</h3>
            @foreach($formas as $forma)
                <p>Área: {{ $forma['area'] }}</p>
                <ul>
                    @foreach($forma['propiedades'] as $propiedad => $valor)
                        <li>{{ $propiedad }}: {{ $valor }}</li>
                    @endforeach
                </ul>
            @endforeach
        @endforeach
    @endif

    <!-- Agregar enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
</body>
</html>
