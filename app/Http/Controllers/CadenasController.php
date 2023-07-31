<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers\CadenasHelper;
use function App\Helpers\CadenasController\invertirPalabra;

class CadenasController extends Controller
{
    public function verTexto()
    {
        return view('cadenas.texto');
    }

    public function mostrarTexto()
    {
        $texto = "Proconsi es una empresa de Tecnologías de la Información y la Comunicación especializada en el desarrollo e integración de soluciones informáticas para todo tipo de empresas. Más de tres décadas de experiencia avalan a una compañía tan flexible como responsable. Cuenta con un equipo multidisciplinar de más de 120 profesionales cualificados, expertos y comprometidos con un único objetivo: hallar la solución tecnológica exacta para cada cliente. Proconsi es especialista en la creación y el desarrollo de software de gestión, consultoría tecnológica, dirección y gestión de proyectos I+D+i basados en TIC, soporte técnico, aplicaciones móviles y fomento de tendencias en nuevas tecnologías, como el cloud computing.";
        return view('cadenas.texto', compact('texto'));
    }

    public function accionTexto(Request $request)
    {
        $texto = $request->input('texto');
        $accion = $request->input('accion');

        if ($accion === 'contar') {
            // Funcionalidad 1: Contar número de caracteres
            $numCaracteres = strlen($texto);
            return view('cadenas.texto', compact('texto', 'numCaracteres'));
        } elseif ($accion === 'mayusculas') {
            // Funcionalidad 2: Convertir el texto a mayúsculas
            $texto = strtoupper($texto);
            return view('cadenas.texto', compact('texto'));
        } elseif ($accion === 'minusculas') {
            // Funcionalidad 3: Convertir el texto a minúsculas
            $texto = strtolower($texto);
            return view('cadenas.texto', compact('texto'));
        } elseif ($accion === 'original') {
            //Funcionalidad 4: No la pide el ejercicio pero me parece pertinente. Devuelve el texto original
            return redirect()->route('mostrarTexto');
        } elseif ($accion === 'repetidas') {
            // Funcionalidad 5: Número de palabras repetidas y cuáles son
            preg_match_all('/\b\pL+\b/u', $texto, $matches);
            $palabras = $matches[0];
            $frecuenciaPalabras = array_count_values($palabras);
            $palabrasRepetidas = array_keys(array_filter($frecuenciaPalabras, function ($frecuencia) {
                return $frecuencia > 1;
            }));
            $numPalabrasRepetidas = count($palabrasRepetidas);
            /* Forma larga, no es óptima, problemas con el patrón, muestra letras y sílabas.
             // Obtener el array de palabras del texto
                $palabras = str_word_count($texto, 1);

            // Filtrar las palabras completas (descartar letras sueltas y sílabas)
            $palabrasFiltradas = array_filter($palabras, function ($palabra) {
            return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $palabra);
            });

            // Contar cuántas veces se repite cada palabra
            $frecuenciaPalabras = array_count_values($palabrasFiltradas);

            // Filtrar las palabras repetidas (aparecen más de una vez)
            $palabrasRepetidas = array_keys(array_filter($frecuenciaPalabras, function ($frecuencia) {
            return $frecuencia > 1;
            }));*/
            return view('cadenas.texto', compact('texto', 'numPalabrasRepetidas', 'palabrasRepetidas'));
        } elseif ($accion === 'reemplazar') {
            // Funcionalidad 6: Reemplazar "Proconsi" por "Isnocorp"
            //Dejo comentada la forma larga de hacerlo
            $palabraActual = 'Proconsi';
            /*Utilizando la función desplazada al helper*/
            $texto = str_replace($palabraActual, invertirPalabra($palabraActual), $texto);
            //Utilizando la función presente en esta misma clase
            /*$texto = str_replace($palabraActual, $this->invertirPalabra($palabraActual), $texto);*/

            //Forma corta
            /* $texto = str_replace('Proconsi', 'Isnocorp', $texto);*/
            return view('cadenas.texto', compact('texto'));
        } elseif ($accion === 'concatenar') {
            // Funcionalidad 7: Concatenar el texto 1000 veces y mostrar el tiempo y longitud final
            $tiempoInicio = microtime(true);
            $textoConcatenado = str_repeat($texto, 1000);
            $tiempoFin = microtime(true);
            $tiempoTardado = round(($tiempoFin - $tiempoInicio) * 1000, 2);
            $longitudFinal = strlen($textoConcatenado);
            return view('cadenas.texto', compact('texto', 'tiempoTardado', 'longitudFinal'));
        }

        // Si no se ha seleccionado ninguna acción válida, regresamos a la vista con el texto original
        return view('cadenas.texto', compact('texto'));
    }

    /**
     * @param $palabra
     * @return string
     * Descripción: recibe una palabra, la convierte a minúsculas,
     * invierte el orden de las letras y convierte la primera letra a mayúscula.
     * Finalment devuelve la palabra resultante
     */
    /*private function invertirPalabra($palabra)
    {
        //Esta implementacion funciona para cualquier palabra recibida como parámetro
        $palabra = strtolower($palabra);
        $palabraInvertida = ucfirst(strrev($palabra));
        return $palabraInvertida;

        /*Primera forma de hacer cambio también a la inversa. Queda comentada
        porque es demasiado específica*/
        /*if ($palabra === 'Proconsi') {
            return 'Isnocorp';
        } elseif ($palabra === 'Isnocorp') {
            return 'Proconsi';
        }*/


}
