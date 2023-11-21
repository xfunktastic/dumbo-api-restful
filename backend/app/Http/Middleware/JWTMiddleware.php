<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            JWTAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if($e instanceof TokenInvalidException){
                return response()->json(['status'=>'Token inválido']);
            }
            if($e instanceof TokenExpiredException){
                return response()->json(['status'=>'Token expirado']);
            }
            return response()->json(['status'=>'Token no encontrado']);
        }
        return $next($request);
    }
}
