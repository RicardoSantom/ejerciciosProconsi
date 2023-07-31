<?php
namespace App\Helpers;
/**
 * Clase que contiene funciones(de momento una) para verificar formato de fechas
 */

use Illuminate\Support\Facades\Validator;
class FechasHelper{

    /**
     * Verifica validez de una fecha en existencia y formato
     *
     * Esta función auna la funcionalidad de verificarFormatoFecha y esFechaValida
     * haciendo las dos comprobaciones, comprueba si se ajusta al formato requerido
     * y tambíén comprueba que la fecha exista en el calendario gregoriano.
     *
     * @param $fecha
     * @return bool
     */
    public static function verificarFechaValida($fecha)
    {
        // Verificar el formato de la fecha (yyyy/MM/dd)
        $patron = "/^\d{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2]\d|3[0-1])$/";
        if (!preg_match($patron, $fecha)) {
            return false;
        }

        // Verificar si la fecha es válida en el calendario gregoriano usando Validator
        list($anio, $mes, $dia) = explode('/', $fecha);
        $validator = Validator::make(['year' => $anio, 'mes' => $mes, 'dia' => $dia], [
            'anio' => 'required|integer|min:1', // El año debe ser un número entero mayor a 0
            'mes' => 'required|integer|between:1,12', // El mes debe ser un número entero entre 1 y 12
            'dia' => 'required|integer|between:1,31', // El día debe ser un número entero entre 1 y 31
        ]);

        return !$validator->fails();
    }

    /**
     * Función que verifica ajuste de fecha a un patrón
     *
     * La variable $patron establece un formato de caracteres admitidos,
     * el parámetro recibido se ha de ajustar a este patrón.
     *
     * @author Ricardo Santiago Tomé
     * @param $fecha
     * @return false|int
     */
    public static function verificarFormatoFecha($fecha)
    {
        // Verificar el formato de la fecha (yyyy/MM/dd)
        $patron = "/^\d{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2]\d|3[0-1])$/";
        return preg_match($patron, $fecha);
    }

    /**
     * Función que verifica la validez de una fecha
     *
     * Esta función recibe una fecha, separa sus componentes y
     * verifica si se corresponden con una fecha válida en el calendario gregoriano.
     * Queda sin utilizar por uso de Validator
     *
     * @param $fecha
     * @return bool
     */
    public static function esFechaValida($fecha)
    {
        //Forma corta
        // Obtener los componentes de la fecha (año, mes, día)
        list($anio, $mes, $dia) = explode('/', $fecha);

        // Verificar si la fecha es válida con la función checkdate()
        return checkdate((int)$mes, (int)$dia, (int)$anio);

        //Forma larga
        /*// Convertir la fecha a timestamp
        $timestamp = strtotime($fecha);

        // Verificar si la fecha es válida en el calendario gregoriano
        $dia = date('d', $timestamp);
        $mes = date('m', $timestamp);
        $anio = date('Y', $timestamp);

        return checkdate($anio, $mes, $dia );*/
    }
}
