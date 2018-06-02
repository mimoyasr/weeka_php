<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
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

    public function create(){
        return "i am here";
    }

    public function store(Request $request)
    {
        $data=$request->all();
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
        }
        $address= Address::create($data);
        return new AddressResource($address);
    }

   
    public function update(Request $request, Address $address)
    {   
        $data=$request->all();
        $address->update($data);
        return new AddressResource($address);
    }


    public function destroy(Address $address)
    {
        return json_encode(['status'=> $address->delete()]);
    }
}
