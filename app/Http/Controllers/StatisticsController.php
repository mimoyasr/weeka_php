<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use App\Meal;
use App\Review;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ret = [];
        $total = $this->user->meals->reduce(function ($carry, $item) {
            return $carry + count($item->inqueryItems);
        });
        $ret['total'] = $total;
        $bestMeal = Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            select('meals.*')->
            where('meals.chef_id', $this->user->id)->
            selectRaw(" avg(rate) AS average ")->
            groupBy('meal_id')->
            orderBy('average', 'desc')->
            limit(1)->
            first();
        $bestMeal = new MealResource($bestMeal);
        $ret['best_meal'] = $bestMeal;
        $totalPrice = $this->user->meals->reduce(function ($carry, $meal) {
            $total = $meal->inqueryItems->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price);
            });
            return $carry + $total;
        });
        $ret['total_price'] = $totalPrice;
        $bestMeals = Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            select('meals.*')->
            where('meals.chef_id', $this->user->id)->
            selectRaw(" avg(rate) AS average ")->
            groupBy('meal_id')->
            orderBy('average', 'desc')->
            limit(4)->
            get();
        $bestMeals = MealResource::collection($bestMeals);
        $ret['best_meals'] = $bestMeals;
        $worstMeals = Meal::join('reviews', 'meals.id', '=', 'reviews.meal_id')->
            select('meals.*')->
            where('meals.chef_id', $this->user->id)->
            selectRaw(" avg(rate) AS average ")->
            groupBy('meal_id')->
            orderBy('average', 'asc')->
            limit(4)->
            get();

        $worstMeals = MealResource::collection($worstMeals);
        $ret['worst_meals'] = $worstMeals;
        $reviews = Review::join('meals', 'meals.id', '=', 'reviews.meal_id')->
            select('reviews.*')->
            where('meals.chef_id', $this->user->id)->
            get();
        $ret['reviews'] = $reviews;
        return response()->json($ret);
    }
}
