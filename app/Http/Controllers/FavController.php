<?php

namespace App\Http\Controllers;

use App\Fav;
use App\Http\Resources\FavResource;
use App\Meal;
use App\User;
use Illuminate\Http\Request;

class FavController extends Controller
{
    private $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = User::find(2);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Meal  $meal
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Meal $meal, Request $request)
    {
        $fav = Fav::where('user_id', $this->user->id)->where('meal_id', $meal->id)->first();
        if (!$fav) {
            $data = [];
            $data['user_id'] = $this->user->id;
            $data['meal_id'] = $meal->id;
            $fav = Fav::create($data);
        }
        return new FavResource($fav);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal, Fav $fav)
    {
        return new FavResource($fav);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal, Fav $fav)
    {
        return response()->json(['status' => $fav->delete()]);
    }
}
