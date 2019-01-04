<?php

namespace App\Http\Middleware;

use Closure;

class UserLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断session是否存在id值和username
        if( $request -> session() -> has('username') && $request -> session() -> has('id') ){

            return $next($request);

        }else{

            return redirect('/');
        }

        
    }
}
