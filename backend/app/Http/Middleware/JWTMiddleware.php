<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle(Request $request, Closure $next):Response
    {
        try{
            JWTAuth::parseToken()->authenticate();

        }catch(\Exception $e){
            if($e instanceof TokenInvalidException){
                return response()->json(['message'=>'El Token no es válido'],401);
            }

            else if($e instanceof TokenExpiredException){
                return response()->json(['message'=>'El Token ha expirado'],401);
            }

            return response()->json(['message'=>'El Token no fue encontrado'],401);

        }

        return $next($request);
    }
}
