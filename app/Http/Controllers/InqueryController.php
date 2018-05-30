<?php

namespace App\Http\Controllers;

use App\Inquery;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\InqueryResource;

class InqueryController extends Controller
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
    public function index()
    {
        $Inquerys = Inquery::where('user_id', $this->user->id )->orderBy('id', 'asc')->get();
        return InqueryResource::collection($Inquerys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $inquery= Inquery::create($data);
        return new InqueryResource($inquery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function show(Inquery $inquery)
    {
        return new InqueryResource($inquery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquery $inquery)
    {
        $data=$request->all();
        $inquery->update($data);
        return new InqueryResource($inquery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquery $inquery)
    {
        return json_encode(['status'=> $address->delete()]);
    }

    public function addItem(Inquery $inquery){

    }

    public function remItem(Inquery $inquery){
        
    }
}
