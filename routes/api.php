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

Route::resource('chefs', 'ChefController')->except(['create','edit']);
Route::resource('clients', 'ClientController')->except(['create','edit','index']);
Route::resource('addresses', 'AddressController')->except(['create','edit','index']);