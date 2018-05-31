<?php

namespace App\Http\Controllers;

use App\User;
use App\Subscribe;
use App\Http\Resources\SubscribeResource;
use Illuminate\Http\Request;

class SubscribeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $chef)
    {
        dd([$chef->subscribers]);
        return SubscribeResource::collection($chef->subscribes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $chef, Request $request)
    {
        $subscribe =  Subscribe::where('user_id',$this->user->id)->where('chef_id',$chef->id)->first();
        if(!$subscribe){
            $data = [];
            $data['user_id'] = $this->user->id;
            $data['chef_id'] = $chef->id;
            $subscribe = Subscribe::create($data);
        }
        return new SubscribeResource($subscribe);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(User $chef, Subscribe $subscribe)
    {
        return new SubscribeResource($subscribe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $chef, Subscribe $subscribe)
    {
        return response()->json(['status' => $subscribe->delete()]);
    }
}
