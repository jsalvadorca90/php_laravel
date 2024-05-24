<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProtegidaController extends Controller
{
    public function protegida_inicio()
    {
        if(session('perfil_id')!=1)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        return view('protegida.home');
    }

    public function protegida_otra()
    {
        return view('protegida.otra');
    }

    public function protegida_sin_acceso()
    {
        return view('protegida.sin_acceso' );
    }
}
