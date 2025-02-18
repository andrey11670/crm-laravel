<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Course;


class CourseController extends Controller
{
    public function __invoke (){

        //$email = 'andrey123.nikiforov.116@gmail.com';
        //$password = 'andrey123';
        //$url =  env('AUTH_APP_URL');
        //dd($url);
        $response = Http::get( 'http://apilayer.net/api/live', [
            'access_key' => 'a0e17678615c1b5ef1c785e3a3720cb5',
            'currencies' => 'RUB'
        ]);
        if ($response->failed()){
            return ['error' => $response->status()];
        }
        $body = (string) $response->getBody();
        function print_arr($course){
            echo '<pre>' .print_r($course, true). '</pre>';
        }
        $course = json_decode($response->getBody(), true);


        if (isset($course['error'])) return  Course::find(1)->course;


        //return print_arr($course);
        return $course['quotes']['USDRUB'];
    }
}


