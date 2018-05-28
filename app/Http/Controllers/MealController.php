<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Review;
use App\Http\Resources\MealResource;
use Illuminate\Http\Request;

class MealController extends Controller
{
  
    public function store(Request $request)
    {
        $data=$request->all();
        $meal= Meal::create($data);
        return new MealResource($meal);
    }

   
    public function show(Meal $meal)
    {
        return new MealResource($meal);
    }

     
    public function update(Request $request, Meal $meal)
    {
        $data=$request->all();
        $meal->update($data);
        return new MealResource($meal);
    }

    public function destroy(Meal $meal)
    {
        return json_encode(['status'=> $meal->delete()]);

    }
}
