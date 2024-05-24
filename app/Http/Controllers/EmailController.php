<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EjemploMailable;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email_inicio()
    {
        return view('email.home');
    }

    public function email_enviar(Request $request)
    {
        $html = "<h2>Este es el cuerpo del correo</h2><hr>Hola más texto";
        $correo = new EjemploMailable($html);
        Mail::to("jsalvadorca90@gmail.com")->send($correo);
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se envió el email exitosamente");
        return redirect()->route('email_inicio');
    }
}
