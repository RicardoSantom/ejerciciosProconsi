<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Vista Main</h1>
    <form method="POST" action="{{ route('instanciarItem') }}" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="cadena">Introduce la cadena (ItemName $$ ## ItemPrice $$ ## ItemQuantity):</label>
            <input type="text" name="cadena" id="cadena" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear instancia de ItemSeparator</button>
    </form>

    @if(isset($itemSeparator))
        <hr>
        <p><strong>Cadena de entrada:</strong> {{ $itemSeparator->getRawInput() }}</p>
        <p><strong>Item Name:</strong> {{ $itemSeparator->getName() }}</p>
        <p><strong>Item Price:</strong> {{ $itemSeparator->getPrice() }}</p>
        <p><strong>Item Quantity:</strong> {{ $itemSeparator->getQuantity() }}</p>
    @else
        <p>No se ha creado ninguna instancia de ItemSeparator.</p>
    @endif
</div>
<a href="{{ route('index') }}" class="btn btn-secondary mt-3">Volver a Index</a>
</div>
<!-- Agregar enlaces a los archivos JS de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>





