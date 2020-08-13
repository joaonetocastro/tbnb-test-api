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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('products', 'ProductsController')->only([
    'index', 'store', 'update', 'destroy'
]);
Route::post('movements', 'MovementsController@store');
Route::get('movements/{productId}', 'MovementsController@getProductMovements');