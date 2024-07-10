<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiAccesoController extends Controller
{
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
        $users = User::where(['email'=>$request->input('correo') ])->first();
        if(!is_object($users))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'Las credenciales ingresadas no son válidas'
                )
            );
            return response()->json($array, 400);
        }
        $users_metadata=UserMetadata::where(['users_id'=>$users->id ])->first();
        if(!is_object($users_metadata))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'Las credenciales ingresadas no son válidas'
                )
            );
            return response()->json($array, 400);
        } 
        if(!Auth::attempt(['email' => $request->input('correo'), 'password' => $request->input('password')]))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'Las credenciales ingresadas no son válidas'
                )
            );
            return response()->json($array, 400);
        }
        $fecha = strtotime(date('Y-m-d H:i:s'));
        $payload = [
            'id'=>$users_metadata->id,
            'iat'=>$fecha
        ];
        $jwt =JWT::encode($payload, env('SECRETO'), 'HS512');
        $array=array
        (
            'estado'=>'ok',
            'nombre'=>$users->name, 
            'token'=>$jwt
        ); 
        return response()->json( $array, 200);
    }
}
