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

Route::resource('chefs', 'ChefController')->except(['create', 'edit']);
Route::resource('inqueries', 'InqueryController')->except(['create', 'edit'])->middleware('jwt.auth');
Route::resource('payments', 'PaymentController')->except(['create', 'edit'])->middleware('jwt.auth');
Route::resource('schedules', 'ScheduledInqueryController')->only(['index'])->middleware('jwt.auth');
Route::resource('clients', 'ClientController')->except(['create', 'edit', 'index']);
Route::resource('addresses', 'AddressController')->except(['edit'])->middleware('jwt.auth');
Route::resource('telephones', 'TelephoneController')->except(['create', 'edit', 'index'])->middleware('jwt.auth');
Route::resource('categories', 'CategoryController')->only(['index', 'show']);
Route::resource('workinghours', 'WorkingHourController')->except(['create', 'edit'])->middleware('jwt.auth');
Route::resource('meals', 'MealController')->except(['index', 'edit', 'create']);
Route::resource('cities', 'CityController')->only(['index']);
Route::resource('countries', 'CountryController')->only(['index']);
Route::resource('districts', 'DistrictController')->only(['index']);
Route::resource('providers', 'ProviderController')->only(['index']);
Route::resource('reviews', 'ReviewController')->except(['index', 'edit', 'create'])->middleware('jwt.auth');
Route::resource('inqueries.inqueryitems', 'InqueryItemController')->except(['create', 'edit'])->middleware('jwt.auth');
Route::resource('meals.favs', 'FavController')->only(['show', 'store', 'destroy'])->middleware('jwt.auth');
Route::resource('chefs.subscribes', 'SubscribeController')->only(['index', 'show', 'store', 'destroy'])->middleware('jwt.auth');
Route::resource('register', 'RegisterationController')->only(['store']);
Route::post('login', 'LoginController@login');
Route::post('forgetpassword', 'ForgotPasswordController@update')->name('forgot.password');
Route::post('hamada',function(){
    echo " i am hamada";
})->name('password.reset');
