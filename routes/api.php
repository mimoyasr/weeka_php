<?php

use Illuminate\Http\Request;
use App\Meal;
use App\Http\Resources\MealResource;

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

Route::get('menu/{slug}',function(string $slug){
    return app('App\Http\Controllers\MenuController')->show("hamada", $slug);
});
Route::resource('countries', 'CountryController')->only(['index']);
Route::resource('districts', 'DistrictController')->only(['index']);
Route::resource('providers', 'ProviderController')->only(['index']);
Route::resource('districts.menu', 'MenuController')->only(['index','show']);
Route::resource('home', 'HomeController')->only(['index']);
Route::resource('chefs', 'ChefController')->except(['create', 'edit','index']);
Route::resource('clients', 'ClientController')->except(['create', 'edit', 'index']);
Route::resource('meals', 'MealController')->except(['index', 'edit', 'create','show']);
Route::resource('cities', 'CityController')->only(['index']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);
Route::post('login', 'LoginController@login');
Route::post('forgetpassword', 'ForgotPasswordController@update')->name('forgot.password');
Route::post('hamada', function () {
    echo " i am hamada";
})->name('password.reset');

Route::middleware('jwt.auth')->group(function () {
    Route::resource('profile', 'ProfileController')->only(['index']);
    Route::resource('inqueries', 'InqueryController')->except(['create', 'edit']);
    Route::resource('inqueries.inqueryitems', 'InqueryItemController')->except(['create', 'edit']);
    Route::resource('payments', 'PaymentController')->except(['create', 'edit']);
    Route::resource('schedules', 'ScheduledInqueryController')->only(['index']);
    Route::resource('addresses', 'AddressController')->except(['edit']);
    Route::resource('telephones', 'TelephoneController')->except(['create', 'edit', 'index']);
    Route::resource('workinghours', 'WorkingHourController')->except(['create', 'edit']);
    Route::resource('reviews', 'ReviewController')->except(['index', 'edit', 'create']);
    Route::resource('meals.favs', 'FavController')->only(['show', 'store', 'destroy']);
    Route::resource('chefs.subscribes', 'SubscribeController')->only(['index', 'show', 'store', 'destroy']);
    Route::resource('chefs.statistics', 'StatisticsController')->only(['index']);
});
