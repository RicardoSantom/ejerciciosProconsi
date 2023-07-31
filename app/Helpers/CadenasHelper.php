<?php
namespace App\Helpers\CadenasController;
function invertirPalabra($palabra): string
{
    $palabra=strtolower($palabra);
    $palabraInvertida = ucfirst(strrev($palabra));
    return $palabraInvertida;
}
