<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * 
     */

    private $token = 'dXNlcjpwYXNzd29yZA';

    public function handle($request, Closure $next)
    {  
        if($request->header('Authorization') != $this->token)
            return json_encode( array('message' => 'Authontication failed'));

        return $next($request);
    }

}