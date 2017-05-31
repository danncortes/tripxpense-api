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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('user', function(){
    return 'hola mundo';
});

//USER
$app->post('user/create', 'UserController@create');

//PAY METHOD
$app->get('pay_method', 'PayMethodController@index');
$app->post('pay_method/create', 'PayMethodController@create');
$app->put('pay_method/update/{id}', 'PayMethodController@update');
$app->delete('pay_method/{id}', 'PayMethodController@delete');
$app->get('pay_method/{id}', 'PayMethodController@find');

//PAY METHOD
$app->get('category', 'CategoryController@index');
/*$app->post('pay_method/create', 'PayMethodController@create');
$app->put('pay_method/update/{id}', 'PayMethodController@update');
$app->delete('pay_method/{id}', 'PayMethodController@delete');
$app->get('pay_method/{id}', 'PayMethodController@find');*/

$app->get('category', 'CategoryController@index');
