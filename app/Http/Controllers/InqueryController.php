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
        $Inqueries = Inquery::where('user_id', $this->user->id )->orderBy('id', 'asc')->get();
        return InqueryResource::collection($Inqueries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $data = $request->except('id', 'user_id');
        $validation=$this->_validation($data);  
        if ($validation===true){
            $data['user_id'] = $this->user->id;
            $inquery= Inquery::create($data);
            return new InqueryResource($inquery);
        }else{
            return $validation;
        }
        
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
        $data = $request->except('id', 'user_id');
        $validation=$this->_validation($data);  
        if ($validation===true){
            $inquery->update($data);
            return new InqueryResource($inquery);
        }else{
            return $validation;
        }
       
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

    private function _validation($data){

      $validator = Validator::make($data, [
            
        
        'telephone_id'=> 'required|exists:telephones,id',
        'address_id' => 'required|exists:addresses,id',
        'payment_id' => 'required|exists:payments,id',
        'state' => 'required|integer|betweeen:-1,0' ]);
        
        if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        return true;

    }



}
