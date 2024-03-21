<?php

use App\Http\Middleware\Authenticate;
use Src\constants\StatusConstants;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
return [
    Request::HTTP_GET => [
        /** TODO */
    ],
    Request::HTTP_POST => [
        
        'user/login' => function () {
            $auth = DataGeneratorFactory::make(ServiceConstants::API_AUTH,[]);
            return $auth->APILoginRequest();
        }
    ]
];


