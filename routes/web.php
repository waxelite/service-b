<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

/**
 * Задачи (Tasks)
 */
$router->group(['prefix' => 'api/tasks'], function () use ($router) {
    $router->get('/', 'TaskController@index');
    $router->get('{id}', 'TaskController@show');
    $router->post('/', 'TaskController@store');
    $router->put('{id}', 'TaskController@update');
    $router->delete('{id}', 'TaskController@destroy');
    $router->get('/categories/{categoryId}', 'TaskController@getTasksByCategory');
});

/**
 * Категории (Categories)
 */
$router->group(['prefix' => 'api/categories'], function () use ($router) {
    $router->get('/', 'CategoryController@index');
    $router->get('{id}', 'CategoryController@show');
    $router->post('/', 'CategoryController@store');
    $router->put('{id}', 'CategoryController@update');
    $router->delete('{id}', 'CategoryController@destroy');
});
