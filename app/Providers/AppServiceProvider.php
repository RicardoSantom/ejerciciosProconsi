<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Helpers\FechasHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        require_once app_path('Helpers/FechasHelper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('fecha_valida', function ($attribute, $value, $parameters, $validator) {
            // Verificar si la fecha es válida en el calendario gregoriano
            return FechasHelper::esFechaValida($value);
        });

        View::composer('fechas.fechas', function ($view) {
            // Verificar si hay un resultado y una acción en la sesión
            $resultado = Session::get('resultado');
            $accion = Session::get('accion');

            // Pasar los valores a la vista
            $view->with('resultado', $resultado)->with('accion', $accion);

            // Borrar las fechas de la sesión si no estamos en la vista fechas.blade.php
            if (!request()->is('fechas')) {
                Session::forget('fecha1');
                Session::forget('fecha2');
            }
        });
    }
}
