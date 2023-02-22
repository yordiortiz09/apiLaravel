<?php

namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class usuarioMiddleware
{
    /**
     * Handle an incoming request.
      * @param  string  $role
      * @return mixed
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( $request, Closure $next,...$role)
    {
        //admi role==1
       
        if (! $request->user()->validaciondelrol(...$role)) {
            abort (403,"No eres administrador");
          
        }
        
            return $next($request);
    
 
        
    }
    
    //    return $next($request);
    }

