<?php

namespace App\Helpers;

class Helpers
{
    public static function fecha($fechaBruto, $tipo = '')
    {
        $fechaArray = explode(' ', $fechaBruto);
        $fecha = explode('-', $fechaArray[0]);
        $diaSemana = date("w", mktime(0, 0, 0, $fecha[1], $fecha[2], $fecha[0]));
        switch ($diaSemana) {
            case '1':
                $diaSemana = "Lunes";
                break;
            case '2':
                $diaSemana = "Martes";
                break;
            case '3':
                $diaSemana = "Miércoles";
                break;
            case '4':
                $diaSemana = "Jueves";
                break;
            case '5':
                $diaSemana = "Viernes";
                break;
            case '6':
                $diaSemana = "Sábado";
                break;
            case '0':
                $diaSemana = "Domingo";
                break;
        }
        switch ($fecha[1]) {
            case '01':
                $mes = "Enero";
                break;
            case '02':
                $mes = "Febrero";
                break;
            case '03':
                $mes = "Marzo";
                break;
            case '04':
                $mes = "Abril";
                break;
            case '05':
                $mes = "Mayo";
                break;
            case '06':
                $mes = "Junio";
                break;
            case '07':
                $mes = "Julio";
                break;
            case '08':
                $mes = "Agosto";
                break;
            case '09':
                $mes = "Septiembre";
                break;
            case '10':
                $mes = "Octubre";
                break;
            case '11':
                $mes = "Noviembre";
                break;
            case '12':
                $mes = "Diciembre";
                break;
        }
        switch ($tipo) {
            case 'datetime':
                $hora = explode(':', $fechaArray[1]);
                return $diaSemana . ' ' . $fecha[2] . ' de ' . $mes . ' de ' . $fecha[0] . ' a las ' . $hora[0] . ':' . $hora[1] . ':' . $hora[2] . ' ';
                break;
            case 'dte':
                return $fecha[0] . '' . $fecha[1] . '' . $fecha[2];
                break;
            default:
                return $diaSemana . ' ' . $fecha[2] . ' de ' . $mes . ' de ' . $fecha[0];
                break;
        }
    }
}
