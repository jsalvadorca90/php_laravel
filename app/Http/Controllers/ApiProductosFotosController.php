<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductosFotos;

class ApiProductosFotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = ProductosFotos::orderBy('id', 'desc')->get();
        return response()->json($datos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(empty($_FILES["foto"]["tmp_name"]))
        {
            $array=array
            (
                'response'=>array
				(
					'estado'=>'Bad Request',
					'mensaje'=>'La foto es obligatoria' 
				)
            );  	
            return response()->json($array, 400);
        }
        if($_FILES["foto"]["type"]=='image/jpeg' or $_FILES["foto"]["type"]=='image/png')
        {
            switch($_FILES["foto"]["type"])
            {
                case 'image/jpeg':
                    $archivo =time().".jpg";
                break;
                case 'image/png':
                    $archivo =time().".png";
                break;
            }
            //copiar
            copy($_FILES["foto"]["tmp_name"], "C:/xampp/htdocs/ronel/curso/ejemplo_1/public/uploads/productos/".$archivo);
            ProductosFotos::create(
                [ 
                    'nombre'=>$archivo,
                    'productos_id'=>$request->input('productos_id'),
                ]
            );
            $array=array
            (
                'response'=>array
				(
					'estado'=>'Ok',
					'mensaje'=>'Se creó el registro exitosamente' 
				)
            );
            return response()->json($array, 201);
        }else
        {
            $array=array
            (
                'response'=>array
				(
					'estado'=>'Bad Request',
					'mensaje'=>'La foto no tiene formato válido' 
				)
            );
            return response()->json($array, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = ProductosFotos::where(['productos_id'=>$id])->orderBy('id', 'desc')->get();
        return response()->json($datos, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $array=array
        (
            'response'=>array
			(
				'estado'=>'Página no encontrada',
				'mensaje'=>'Página no encontrada' 
			)
        );  	
        return response()->json($array, 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos=ProductosFotos::where(['id'=>$id])->firstOrFail();
        unlink("C:/xampp/htdocs/ronel/curso/ejemplo_1/public/uploads/productos/".$datos->nombre);
        ProductosFotos::where(['id'=>$id])->delete();
        $array=array
        (
            'estado'=>'ok',
            'mensaje'=>'Se eliminó el registro exitosamente', 
        ); 
        return response()->json( $array, 200);
    }
}
