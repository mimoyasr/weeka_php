<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Resources\AddressResource;

use Illuminate\Http\Request;

class AddressController extends Controller
{
  
   
    // public function show(Address $address)
    // {
    //     return new AddressResource($address);
    // }

    public function store(Request $request)
    {
        $data=$request->all();
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
