<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EjemploController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "método GET";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "método POST";
        // $json = json_decode(file_get_contents('php://input'));
        // print_r($json);
        // $json = json_decode(file_get_contents('php://input'), true);
        // echo $json['correo'];
        echo $request->input('correo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "método GET con parámetro | id=".$id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        echo "método PUT | id=".$id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "método DELETE | id=".$id;
    }
}
