<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FechasHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class FechasController extends Controller
{
    public function fechas()
    {
        // Obtener las fechas ingresadas en el formulario desde la sesión si están presentes.
        // Para poder ejecutar diferentes acciones sin re-ingresar fechas.
        $fecha1 = session('fecha1');
        $fecha2 = session('fecha2');

        // Verificar si hay un resultado y una acción en la sesión
        $resultado = session('resultado');
        $accion = session('accion');

        return view('fechas.fechas', compact('resultado', 'accion', 'fecha1', 'fecha2'));
    }

     public function procesarFormulario(Request $request)
    {
        // Obtener el botón pulsado
        $accion = $request->input('accion');

        // Verificar si se ha pulsado un botón y, si es así, eliminar el mensaje de error
        if ($accion) {
            Session::forget('fecha1_error');
            Session::forget('fecha2_error');
        }

        // Si se ha pulsado un botón, realizar la validación de las fechas
        if ($accion && $accion !== 'calcularDiferenciaDias' && $accion !== 'calcularInicioFinAni'
            && $accion !== 'calcularNumeroSemana' && $accion !== 'calcularNumeroSemana') {
            // Validar las fechas usando las reglas de validación de Laravel
            $validator = Validator::make($request->all(), [
                'fecha1' => 'required|date_format:Y/m/d',
                'fecha2' => 'required|date_format:Y/m/d',
            ],
                [
                    'required' => 'Campo obligatorio',
                    'date_format' => 'El formato se ha de ajustar a yyyy/MM/dd y ser una fecha válida',
                ]);

            // Verificar si la validación ha fallado
            if ($validator->fails()) {
                $errors = $validator->errors();
                if ($errors->has('fecha1')) {
                    Session::put('fecha1_error', $errors->first('fecha1'));
                }
                if ($errors->has('fecha2')) {
                    Session::put('fecha2_error', $errors->first('fecha2'));
                }
                return redirect()->back();
            }
        }

        // Obtener las fechas ingresadas en el formulario
        $fecha1 = $request->input('fecha1');
        $fecha2 = $request->input('fecha2');

        // Verificar si las fechas tienen el formato correcto usando el helper
        // Comentada porque he descubierto Validator!!!
        /*if (!FechasHelper::verificarFormatoFecha($fecha1) || !FechasHelper::verificarFormatoFecha($fecha2)) {
            return redirect()->back()
                ->withErrors(['formatoFecha' => 'El formato de las fechas debe ser yyyy/MM/dd'])
                ->withInput(compact('fecha1', 'fecha2'));
        }*/

        // Verificar si las fechas son válidas en el calendario gregoriano usando el helper
        if ($accion && ($accion === 'calcularDiferenciaDias' || $accion === 'calcularInicioFinAnio'
            || $accion ==='calcularDiasAnio' || $accion==='calcularNumeroSemana')) {
            if (!FechasHelper::esFechaValida($fecha1)) {
                Session::put('fecha1_error', 'Fecha 1 no es válida en el calendario gregoriano.');
                return redirect()->back();
            }
            if (!FechasHelper::esFechaValida($fecha2)) {
                Session::put('fecha2_error', 'Fecha 2 no es válida en el calendario gregoriano.');
                return redirect()->back();
            }
        }

        // Ejecutar la función correspondiente según el botón pulsado
        switch ($accion) {
            case 'calcularDiferenciaDias':
                $resultado = $this->calcularDiferenciaDias($fecha1, $fecha2);
                break;
            case 'calcularInicioFinAnio':
                $resultado = $this->calcularInicioFinAnio($fecha1, $fecha2);
                break;
            case 'calcularDiasAnio':
                $resultado = $this->calcularDiasAnio($fecha1, $fecha2);
                break;
            case 'calcularNumeroSemana':
                $resultado = $this->calcularNumeroSemana($fecha1, $fecha2);
                break;
            default:
                $resultado = null;
                break;
        }

        // Almacenar fechas, resultado y el valor de $accion en la sesión
        $request->session()->put('fecha1', $fecha1);
        $request->session()->put('fecha2', $fecha2);
        $request->session()->put('resultado', $resultado);
        $request->session()->put('accion', $accion);

        // Redirigir a la misma vista con las fechas conservadas
        return redirect()->route('fechas');
    }
        public function calcularDiferenciaDias( $fecha1, $fecha2)
    {
        // Convertir las fechas a timestamps
        $timestamp1 = strtotime($fecha1);
        $timestamp2 = strtotime($fecha2);

        // Calcular la diferencia en segundos
        $diferenciaSegundos = abs($timestamp2 - $timestamp1);

        // Calcular la diferencia en días
        $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));

        // Mensaje con el resultado
        $resultado = "La diferencia entre $fecha1 y $fecha2 es de $diferenciaDias días.";

        return $resultado;
    }

    public function calcularInicioFinAnio($fecha1, $fecha2)
    {
        // Convertir las fechas a timestamps
        $timestamp1 = strtotime($fecha1);
        $timestamp2 = strtotime($fecha2);

        // Obtener el año de las fechas
        $anio1 = date('Y', $timestamp1);
        $anio2 = date('Y', $timestamp2);

        // Obtener el número del día de la semana para el 1 de enero de cada fecha
        $numDiaSemana1 = date('w', mktime(0, 0, 0, 1, 1, date('Y', $timestamp1)));
        $numDiaSemana2 = date('w', mktime(0, 0, 0, 1, 1, date('Y', $timestamp2)));

        // Traducir el número del día de la semana al español
        $diasSemana = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $diaSemana1 = $diasSemana[$numDiaSemana1];
        $diaSemana2 = $diasSemana[$numDiaSemana2];

        // Obtener el número del día de la semana para el 31 de diciembre de cada fecha
        $numDiaSemana31Dic1 = date('w', mktime(0, 0, 0, 12, 31, date('Y', $timestamp1)));
        $numDiaSemana31Dic2 = date('w', mktime(0, 0, 0, 12, 31, date('Y', $timestamp2)));

        // Traducir el número del día de la semana al español
        $diaSemana31Dic1 = $diasSemana[$numDiaSemana31Dic1];
        $diaSemana31Dic2 = $diasSemana[$numDiaSemana31Dic2];

        // Armar el mensaje con los resultados en español
        $resultado = "El 1 de enero del año $anio1 es  $diaSemana1
        \ny el 31 de diciembre del año $anio1 es $diaSemana31Dic1 .
        \nEl 1 de enero del año $anio2 es $diaSemana2
        \ny el 31 de diciembre del año $anio2 es $diaSemana31Dic2 .";

        return $resultado;
    }

    public function calcularDiasAnio($fecha1, $fecha2)
    {
        // Convertir las fechas a timestamps
        $timestamp1 = strtotime($fecha1);
        $timestamp2 = strtotime($fecha2);

        // Calcular el número de días del año para cada fecha
        $diasAnio1 = date('z', $timestamp1) + 1;
        $diasAnio2 = date('z', $timestamp2) + 1;

        // Mensaje con el resultado
        $resultado = "Para la fecha $fecha1, el número de días transcurridos desde el inicio del año es $diasAnio1 días."
            . " Para la fecha $fecha2, el número de días transcurridos desde el inicio del año es $diasAnio2 días.";

        return $resultado;
    }

    public function calcularNumeroSemana($fecha1, $fecha2)
    {
        // Convertir las fechas a timestamps
        $timestamp1 = strtotime($fecha1);
        $timestamp2 = strtotime($fecha2);

        // Obtener el número de la semana para cada fecha
        $numeroSemana1 = date('W', $timestamp1);
        $numeroSemana2 = date('W', $timestamp2);

        // Mensaje con el resultado
        $resultado = "Para la fecha $fecha1, el número de la semana es $numeroSemana1."
            . " Para la fecha $fecha2, el número de la semana es $numeroSemana2.";

        return $resultado;
    }
}
