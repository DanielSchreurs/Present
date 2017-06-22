<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    // API

//    Route::group(['domain' => env('DOMAIN_API')], function () {
//        include('Routes/Api/ApiRoutes.php');
//    });
    // www
    Route::group(['middleware' => 'HTMLMin','domain' => env('DOMAIN')], function () {
        include('Routes/Www/WwwRoutes.php');
    });
    /*Route::group(['middleware' => 'HTMLMin','domain' => env('DOMAINWWW')], function () {
        include('Routes/Www/WwwRoutes.php');
    });*/


