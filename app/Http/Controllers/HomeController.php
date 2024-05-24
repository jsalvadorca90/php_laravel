<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_inicio()//el nombre del método también se puede colocar en notación camelCase "homeInicio"
    {
        $texto = "hola con ñandú";
        $numero = 12;
        $paises=array(
            array(
                "nombre"=>"Chile", "dominio"=>"cl"
            ),
            array(
                "nombre"=>"Perú", "dominio"=>"pe"
            ),
            array(
                "nombre"=>"Venezuela", "dominio"=>"ve"
            ),
            array(
                "nombre"=>"México", "dominio"=>"mx"
            ),
            array(
                "nombre"=>"España", "dominio"=>"es"
                )
            );
            return view('home.home', compact('texto', 'numero', 'paises'));
            // return view('home.home', ['texto'=>$texto]);
    }
        
    public function home_hola()
    {
        echo "hola desde ola";
    }

    public function home_parametros($id,$slug)
    {
        echo "id=" . $id . " | slug=" . $slug . " | page=" . $_GET['page'];
    }
}
