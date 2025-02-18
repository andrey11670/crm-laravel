<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi extends Middleware
{

    public function handle( $request, $guards)
    {
       $request->query('api_token');
       if (empty($token)) {
            $token = $request->input('api_token');
       }

    }
}
