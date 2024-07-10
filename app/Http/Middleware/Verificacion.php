<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Verificacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = explode(' ', $request->header('Authorization'));
        if(!isset( $headers[1]))
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Unauthorized',
                    'mensaje'=>'Acceso no autorizado'
                )
            );
            return response()->json($array, 401);
        }
        //decodificar el token
        $decoded = JWT::decode($headers[1], new Key(env('SECRETO'), 'HS512'));
        //validar si es válido o no
        $fecha = strtotime(date('Y-m-d H:i:s'));
        //echo $decoded->iat." | ".$fecha;exit;        
        if($decoded->iat > $fecha)
        {
            $array=array
            (
                'response'=>array
                (
                    'estado'=>'Unauthorized',
                    'mensaje'=>'Acceso no autorizado'
                )
            );
            return response()->json($array, 401);
        }
        return $next($request);
    }
}
