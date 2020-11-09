<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/test', function () use ($router) {
    return "Hello Word";
});

$router->get('user', 'Controller@index');

$router->get('user/{id}', 'Controller@getid');

$router->post('user', 'Controller@store');

$router->put('user/{id}', 'Controller@update');

$router->delete('user/{id}', 'Controller@destroy');