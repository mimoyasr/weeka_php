<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MealResource;
use App\Http\Resources\DistrictResource;
use App\User;
use App\Meal;
use App\Review;
use App\District;

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
        $districts = District::all();

        $mealAverage=Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
                        select('meals.*')->
                        selectRaw(" avg(rate) AS average ")->
                        groupBy('meal_id')->
                        orderBy('average', 'desc')->
                        limit(4)->
                        get();
        
        return [
            'meals' => MealResource::collection($mealAverage),
            'districts' => DistrictResource::collection($districts)
        ];
    }
}
