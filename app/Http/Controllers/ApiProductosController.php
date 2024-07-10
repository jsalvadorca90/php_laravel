<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Productos;
use App\Models\ProductosFotos;
// use Illuminate\Routing\Controller; //para uso del middleware



class ApiProductosController extends Controller
{
    // también funciona así pero agregando "use Illuminate\Routing\Controller;"
    // public function __construct()
    // {
    //     $this->middleware('auth.basic');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Productos::orderBy('id', 'desc')->get();
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
        //crear el registro de productos
        Productos::create(
            [
                'nombre'=>$request->input('nombre'),
                'slug'=>Str::slug($request->input('nombre'), '-'),
                'descripcion'=>$request->input('descripcion'), 
                'precio'=>$request->input('precio'),
                'categorias_id'=>$request->input('categorias_id'),
                'fecha'=>date('Y-m-d')
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
        $datos=Productos::where(['id'=>$id])->firstOrfail();
        return response()->json( $datos, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos=Productos::where(['id'=>$id])->first();
        //consultar si la tabla tiene datos
        if(!is_object($datos))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'La peticion HTTP no trae datos para procesar'
                )
            ); 
            return response()->json( $array, 404);
        }else
        {
            $json = json_decode(file_get_contents('php://input'), true);
            if(!is_array($json))
            {
                $array=
                    array
                    (
                        'response'=>array
                        (
                            'estado'=>'Bad Request',
                            'mensaje'=>'La peticion HTTP no trae datos para procesar'
                        )
                    );	
                return response()->json($array, 400);
            }
            //ejecuto el update
            $datos->nombre=$json['nombre'];
            $datos->slug=Str::slug($json['nombre'], '-');
            $datos->precio=$json['precio'];
            $datos->descripcion=$json['descripcion'];
            $datos->categorias_id=$json['categorias_id'];
            $datos->save();
            //retorno un json
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'ok',
                    'mensaje'=>'Se modificó el registro exitosamente'
                )
            ); 
            return response()->json( $array, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos=Productos::where(['id'=>$id])->firstOrFail();        
        //existe ProductosFotos con productos_id
        $existe = ProductosFotos::where(['productos_id'=>$id])->count();
        if($existe==0)
        {
            Productos::where(['id'=>$id])->delete();
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'ok',
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
                    'estado'=>'Bad Request',
                    'mensaje'=>'No se puede eliminar el registro',  
                )
            );           
            return response()->json( $array, 400);
        }        
    }
}
