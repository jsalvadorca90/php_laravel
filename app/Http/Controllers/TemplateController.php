<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template_inicio()
    { 
        return view('template.home' );
    }

    public function template_stack()
    { 
        return view('template.stack' );
    }
}
