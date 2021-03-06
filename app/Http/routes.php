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

//PAY METHOD
$app->get('pay_method', 'PayMethodController@index');
$app->post('pay_method/create', 'PayMethodController@create');
$app->put('pay_method/update/{id}', 'PayMethodController@update');
$app->delete('pay_method/{id}', 'PayMethodController@delete');
$app->get('pay_method/{id}', 'PayMethodController@find');

//CATEGORY
$app->get('category', 'CategoryController@index');
$app->delete('category/{id}', 'CategoryController@delete');
$app->post('category/create', 'CategoryController@create');

//TRAVEL
$app->get('travels/{user_id}', 'TravelController@index');
$app->get('travel/{id}', 'TravelController@find');
$app->post('travel/create', 'TravelController@create');
$app->delete('travel/{id}', 'TravelController@delete');
$app->put('travel/update/{travel_id}', 'TravelController@update');

//STATS_PAYMETHOD_TRAVEL
$app->get('stats/paymethod_travel/{user_id}/{travel_id}' , 'StatsController@getPaymethodTravel');
//STATS_CATEGORY_TRAVEL
$app->get('stats/category_travel/{user_id}/{travel_id}' , 'StatsController@getCategoryTravel');


//OPERATIONS
$app->get('operations/{user_id}', 'OperationController@index');
$app->get('operation/{id}', 'OperationController@find');
$app->get('operations_by_travel/{user_id}/{cod_travel}', 'OperationController@operationsByTravel');
$app->post('operation/create', 'OperationController@create');
$app->delete('operation/{id}', 'OperationController@delete');
$app->put('operation/update/{operation_id}', 'OperationController@update' );

