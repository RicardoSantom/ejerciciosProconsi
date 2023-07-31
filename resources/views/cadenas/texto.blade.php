<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>{{ $texto }}</p>

<form method="POST" action="{{ route('accionTexto') }}">
    @csrf
    <input type="hidden" name="texto" value="{{ $texto }}">
    <button type="submit" name="accion" value="contar">Contar Caracteres</button>
    <button type="submit" name="accion" value="mayusculas">Convertir a Mayúsculas</button>
    <button type="submit" name="accion" value="minusculas">Convertir a Minúsculas</button>
    <button type="submit" name="accion" value="original">Volver a texto original</button>
    <button type="submit" name="accion" value="repetidas">Palabras Repetidas</button>
    <button type="submit" name="accion" value="reemplazar">Reemplazar "Proconsi" por "Isnocorp"</button>
    <button type="submit" name="accion" value="concatenar">Concatenar 1000 veces</button>

    @if(isset($numCaracteres))
        <div>Número de caracteres: {{ $numCaracteres }}</div>
    @endif

    @if(isset($numPalabrasRepetidas) && $numPalabrasRepetidas > 0)
        <div>Número de palabras repetidas: {{ $numPalabrasRepetidas }}</div>
        <div>Palabras repetidas: {{ implode(' - ', $palabrasRepetidas) }}</div>
    @endif

    @if(isset($tiempoTardado) && isset($longitudFinal))
        <div>Tiempo de concatenación: {{ $tiempoTardado }} ms</div>
        <div>Longitud final del texto concatenado: {{ $longitudFinal }}</div>
    @endif
</form>
@if(isset($textoConcatenado))
    <div style="display: none;">
        {{ $textoConcatenado }}
    </div>
@endif

</body>
</html>
