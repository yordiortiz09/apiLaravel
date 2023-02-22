<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     * @param  string  $role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
      * @return mixed
     */
    public function handle(Request $request, Closure $next,...$role )
    {
    
   
         if ($request->user()->status!=1)
         {

             abort (403,"La seccion esta cerrada");
         }
      if (!$request->user()->validaciondelrol($role) )
      {
        
        abort (403,"No estas autorizadooooooooooo");
      }
      return $next ($request);
      
     
    }
}
