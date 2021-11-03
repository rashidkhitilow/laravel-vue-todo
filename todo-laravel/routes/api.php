<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('profile', 'JWTAuthController@profile');

    Route::get('/todos', 'TodosController@index');
    Route::post('/todos', 'TodosController@store');
    Route::put('/todos/{todo}', 'TodosController@update');
    Route::delete('/todos/{todo}', 'TodosController@destroy');
    Route::put('/todosCheckAll', 'TodosController@updateAll');
    Route::delete('/todosDeleteCompleted', 'TodosController@destroyCompleted');

    Route::get('/products', 'ProductsController@index');
    Route::post('/products/new', 'ProductsController@new');
    Route::post('/products/save/{id}', 'ProductsController@save');
    Route::delete('/products/remove/{id}', 'ProductsController@remove');
    Route::get('/products/filter', 'ProductsController@filter');
    Route::get('/autocomplete/products', 'ProductsController@autocomplete');

    Route::get('/lunits', 'LUnitsController@index');
    Route::get('/lunits/allWithPagination', 'LUnitsController@allWithPagination');
    Route::post('/lunits/new', 'LUnitsController@new');
    Route::post('/lunits/save/{id}', 'LUnitsController@save');
    Route::delete('/lunits/remove/{id}', 'LUnitsController@remove');
    Route::get('/autocomplete/lunits', 'LUnitsController@autocomplete');

    Route::get('/refreshToken', 'JWTAuthController@refresh');
    Route::post('/logout', 'JWTAuthController@logout');
});

Route::post('/login', 'JWTAuthController@login');
Route::post('/register', 'JWTAuthController@register');
