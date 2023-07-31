<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GeneracionAleatoriaController extends Controller
{
   public function mostrarVista()
    {
        return view('aleatoria.generacionAleatoria');
    }

    public function generarFormas(Request $request)
    {
        $numCirculos = $request->input('num_circulos');
        $numCuadrados = $request->input('num_cuadrados');
        $numTriangulos = $request->input('num_triangulos');

        $formas = $this->generarFormasAleatorias($numCirculos, $numCuadrados, $numTriangulos);
        $formasAgrupadas = $this->agruparFormasPorTipo($formas);

        return view('aleatoria.generacionAleatoria', compact('formas', 'formasAgrupadas'));
    }

    private function generarFormasAleatorias($numCirculos, $numCuadrados, $numTriangulos)
    {
        $formas = [];

        for ($i = 0; $i < $numCirculos; $i++) {
            $radio = rand(1, 10);
            $area = round(pi() * pow($radio, 2), 2);
            $formas[] = [
                'tipo' => 'Círculo',
                'area' => $area,
                'propiedades' => ['Radio' => $radio],
            ];
        }

        for ($i = 0; $i < $numCuadrados; $i++) {
            $lado = rand(1, 10);
            $area = pow($lado, 2);
            $formas[] = [
                'tipo' => 'Cuadrado',
                'area' => $area,
                'propiedades' => ['Lado' => $lado],
            ];
        }

        for ($i = 0; $i < $numTriangulos; $i++) {
            $base = rand(1, 10);
            $altura = rand(1, 10);
            $area = round(($base * $altura) / 2, 2);
            $formas[] = [
                'tipo' => 'Triángulo',
                'area' => $area,
                'propiedades' => ['Base' => $base, 'Altura' => $altura],
            ];
        }

        return $formas;
    }

    private function agruparFormasPorTipo($formas)
    {
        $formasAgrupadas = [];

        foreach ($formas as $forma) {
            $tipo = $forma['tipo'];
            $formasAgrupadas[$tipo][] = $forma;
        }

        // Ordenar las formas dentro de cada tipo por área (de menor a mayor)
        foreach ($formasAgrupadas as &$formasTipo) {
            $formasTipo = Arr::sort($formasTipo, function ($forma) {
                return $forma['area'];
            });
        }

        return $formasAgrupadas;
    }
}
