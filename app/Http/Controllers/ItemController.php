<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemSeparator;

class ItemController extends Controller
{
   public function instanciarItem(Request $request) {
    $rawInput = $request->input('cadena');

    // Crear una instancia de ItemSeparator con la cadena de entrada
    $itemSeparator = new ItemSeparator($rawInput);

    // Mostrar la salida
    return view('clases.main', compact('itemSeparator'));
}

    public function mostrarVista()
    {
        return view('clases.main');
    }

}
