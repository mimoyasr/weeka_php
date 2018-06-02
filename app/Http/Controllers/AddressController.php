<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
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

    public function show(Address $address)
    {
        return new AddressResource($address);
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $validation= $this->_validation($data);
        if( $validation === true){
            $data['user_id']=$this->user->id;
            $user = Address::where('user_id', '=', $this->user->id)->where('name', '=', $request->name)->first();
            if ($user === null) {
                $address= Address::create($data);
                return new AddressResource($address);
            }else{                       
                return response()->json(['message' => 'This Name already exists'], 422);
            }
          
        }else {
           return $validation ;
        }
       
       
    }

   
    public function update(Request $request, Address $address)
    {   
        $data=$request->all();
        $validation= $this->_validation($data);
        if( $validation === true){
            if($address->name != $request->name){
                $user = Address::where('user_id', '=', $this->user->id)->where('name', '=', $request->name)->first();
            if ($user === null) {
                $address->update($data);
                return new AddressResource($address);
            }else{                       
                return response()->json(['message' => 'This Name already exists'], 422);
            }
            } else {
                $address->update($data);
                return new AddressResource($address);
            }
            
        }else {
           return $validation ;
        }
       
    }


    public function destroy(Address $address)
    {
        return json_encode(['status'=> $address->delete()]);
    }

    private function _validation($data){

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'street' => 'required|max:100',
            'buildingno' => 'required|min:1',
            'floorno' => 'min:1',
            'flatno' => 'min:1',
            'notice' => 'max:255',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors(), 422);
        }else {
            return true;
        }
    }

}
