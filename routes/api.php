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

<<<<<<< HEAD
Route::resource('chefs', 'ChefController')->except(['create','edit']);
Route::resource('clients', 'ClientController')->except(['create','edit','index']);
Route::resource('addresses', 'AddressController')->except(['create','edit','index']);
Route::resource('telephones', 'TelephoneController')->except(['create','edit','index']);
Route::resource('workinghours', 'WorkingHourController')->except(['create','edit','index']);
=======
Route::resource('chefs', 'ChefController')->except(['create', 'edit']);
Route::resource('clients', 'ClientController')->except(['create', 'edit', 'index']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);
Route::resource('addresses', 'AddressController')->except(['create', 'edit', 'index']);
>>>>>>> a4abc06eedea187f11e615e0c7226f5e6ebd0271
