<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function login (Request $request){
        $email = 'andrey123.nikiforov.116@gmail.com';
        $password = 'andrey123';

        $domain = $request->getHost();
        $scheme = $request->getScheme(); // "http" или "https"

        $loginUrl = $scheme . '://' . $domain . '/api/auth/login';

        $response = Http::post( $loginUrl, [
            'email' => $email,
            'password' => $password
        ]);
        if ($response->failed()){
            return ['error' => $response->status()];
        }
        $body = (string) $response->getBody();

        return json_decode($response->getBody(), true);
    }

}
