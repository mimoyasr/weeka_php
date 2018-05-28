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
Route::resource('telephones', 'TelephoneController')->except(['create','edit','index']);
// Route::resource('workinghours', 'WorkingHourController')->except(['create','edit','show']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);
Route::get('/workinghours', 'WorkingHourController@index')->name('workinghours.index');
Route::post('/workinghours', 'WorkingHourController@store')->name('workinghours.store');
Route::patch('/workinghours/{id}', 'WorkingHourController@update')->name('workinghours.update');
Route::delete('/workinghours/{id}', 'WorkingHourController@destroy')->name('workinghours.destroy');