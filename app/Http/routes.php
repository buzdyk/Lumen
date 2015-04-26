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

$app->get('/', function() use ($app) {
    return $app->welcome();
});

$app->post('/register', ['uses' => 'App\Http\Controllers\AuthController@postRegister']);
$app->post('/login', ['uses'    => 'App\Http\Controllers\AuthController@postLogin']);

$app->get('/post/{id}', ['uses' => 'App\Http\Controllers\PostsController@show']);
$app->get('/post',      ['uses' => 'App\Http\Controllers\PostsController@index']);
$app->group(['middleware' => 'logged.in'], function($app) {
    $app->post('/post',     ['uses' => 'App\Http\Controllers\PostsController@store']);
    /** & another protected routes */
});
