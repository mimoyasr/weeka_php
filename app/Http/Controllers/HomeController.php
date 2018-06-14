<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Meal;
use App\User;
use App\Fav;
use App\Inquery;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            select('meals.*')->
            selectRaw(" avg(rate) AS rate ")->
            groupBy('meal_id')->
            orderBy('rate', 'desc')->
            limit(4)->
            get();

        if ($this->user) {
            $user = $this->user;
            $menu->map(function ($meal) use ($user) {
                $meal['fav'] = Fav::where('user_id', $user->id)->where('meal_id', $meal->id)->first() ? true : false;
            });
            $menu->map(function ($meal) use ($user) {
                $meal['commentState'] = Inquery::join('inquery_items', 'inqueries.id', '=', 'inquery_items.inquery_id')->
                    where('inqueries.user_id', $user->id)->
                    where('inquery_items.meal_id', $meal->id)->first() ? true : false;
            });
        }

        return [
            'meals' => MenuResource::collection($menu),
        ];
    }
}
