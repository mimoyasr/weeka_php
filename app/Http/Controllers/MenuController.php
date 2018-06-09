<?php

namespace App\Http\Controllers;

use App\Fav;
use App\Http\Resources\MenuResource;
use App\Meal;
use App\User;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Meal::join('users', 'users.id', '=', 'meals.chef_id')->
            join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            join('addresses', 'users.id', '=', 'addresses.user_id')->
            join('districts', 'districts.id', '=', 'addresses.district_id')->
            selectRaw('meals.*, avg(reviews.rate) AS rate ')->
            groupBy('reviews.meal_id')->
            paginate(5);

        if ($this->user) {
            $user = $this->user;
            $menu->map(function ($meal) use ($user) {
                $meal['fav'] = Fav::where('user_id', $user->id)->where('meal_id', $meal->id)->first() ? true : false;
            });
        }

        return MenuResource::collection($menu);
    }

    public function show($slug)
    {
        $mealAverage = Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            where('slug', $slug)->
            selectRaw('meals.id ,meals.*')->
            selectRaw(" avg(rate) AS rate ")->
            groupBy('meal_id')->
            first();

        if ($this->user) {
            $mealAverage['fav'] = Fav::where('user_id', $this->user->id)
                ->where('meal_id', $mealAverage->id)
                ->first() ? true : false;
        }
        // return $mealAverage;
        return new MenuResource($mealAverage);
    }
}
