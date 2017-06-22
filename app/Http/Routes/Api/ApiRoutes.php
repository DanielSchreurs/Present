<?php
    $api = app('Dingo\Api\Routing\Router');

    $api->version('v1', function ($api) {
        $api->get('/', 'App\Http\Controllers\Api\V1\RouteController@index');
    });

    $api->version('v1', function ($api) {
        $api->get('users/', 'App\Http\Controllers\Api\V1\UserController@index');
    });
    $api->version('v1', function ($api) {
        $api->post('users/store','App\Http\Controllers\Api\V1\UserController@store');
    });
    $api->version('v1', function ($api) {
        $api->put('users/update/{id}','App\Http\Controllers\Api\V1\UserController@update');
    });
    $api->version('v1', function ($api) {
        $api->delete('users/destroy/{id}','App\Http\Controllers\Api\V1\UserController@destroy');
    });
    $api->version('v1', function ($api) {
        $api->get('users/{id}', 'App\Http\Controllers\Api\V1\UserController@show');
    });