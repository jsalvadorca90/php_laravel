<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categorias;
use App\Models\Productos;

class ApiCategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Categorias::orderBy('id', 'desc')->get();
        return response()->json($datos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //recibir el json
        $json = json_decode(file_get_contents('php://input') , true);
        //print_r($json);
        //validar que viene un json
        if(!is_array($json ))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'La peticion HTTP no trae datos para procesar'
                )
            );
            return response()->json($array, 400);
        }
       //crear el registro
        Categorias::create(
            [
                'nombre'=>$request->input("nombre"),
                'slug'=>Str::slug($request->input("nombre"))
            ]
        );
        //retornar un json
        $array=array
        (
            'response'=>array
            (
                'estado'=>'ok',
                'mensaje'=>'Se creó el registro exitosamente'
            )
        ); 
        return response()->json( $array, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos=Categorias::where(['id'=>$id])->firstOrfail();
        return response()->json( $datos, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if(!is_array($json ))
            {
                $array=array
                (
                    'response'=>array
                    (
                        'estado'=>'Bad Request',
                        'mensaje'=>'La peticion HTTP no trae datos para procesar ' 
                    )
                );  	
                return response()->json($array, 400);
            }
            //ejecuto el update
            $datos=Categorias::where(['id'=>$id])->firstOrFail();
            $datos->nombre=$request->input('nombre');
            $datos->slug=Str::slug($request->input('nombre'));
            $datos->save();
            //retorno un json
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'ok',
                    'mensaje'=>'Se modificó el registro exitosamente', 
                )
            ); 
            return response()->json( $array, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos=Categorias::where(['id'=>$id])->firstOrFail();
        if(Productos::where(['categorias_id'=>$id])->count() == 0)
        {
            Categorias::where(['id'=>$id])->delete();
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Ok',
                    'mensaje'=>'Se eliminó el registro exitosamente'
                )
            ); 
            return response()->json( $array, 200);
        }else
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad request',
                    'mensaje'=>'No se puede eliminar el registro'
                )
            ); 
            return response()->json( $array, 400);
        }
    }
}
