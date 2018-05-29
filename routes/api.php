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
Route::resource('inquerys', 'InqueryController')->except(['create','edit']);
Route::resource('clients', 'ClientController')->except(['create','edit','index']);
Route::resource('addresses', 'AddressController')->except(['create','edit','index']);
Route::resource('telephones', 'TelephoneController')->except(['create','edit','index']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);
Route::get('/workinghours', 'WorkingHourController@index')->name('workinghours.index');
Route::post('/workinghours', 'WorkingHourController@store')->name('workinghours.store');
Route::patch('/workinghours/{id}', 'WorkingHourController@update')->name('workinghours.update');
Route::delete('/workinghours/{id}', 'WorkingHourController@destroy')->name('workinghours.destroy');
Route::resource('meals', 'MealController')->except(['index', 'edit','create']);
Route::resource('cities', 'CityController')->only(['index']);
Route::resource('countries', 'CountryController')->only(['index']);
Route::resource('districts', 'DistrictController')->only(['index']);
Route::resource('providers', 'ProviderController')->only(['index']);
Route::resource('reviews', 'ReviewController')->except(['index', 'edit','create']);
