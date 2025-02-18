<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function login (){
        $email = 'andrey123.nikiforov.116@gmail.com';
        $password = 'andrey123';
        $url =  env('AUTH_APP_URL');
        //dd($url);
        $response = Http::post( 'http://127.0.0.1:8000/api/auth/login', [
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
