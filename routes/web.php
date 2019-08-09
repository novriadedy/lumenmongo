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

//$app->get('/', function () use ($app) {
//    return $app->version();
//});

$app->get('/', 'PersonController@index');
$app->get('/person', 'PersonController@all');
$app->get('/person/{id}', 'PersonController@show');
$app->post('/person', 'PersonController@store');
$app->put('/person/{id}', 'PersonController@update');
$app->delete('/person/{id}', 'PersonController@destroy');
