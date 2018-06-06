<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;

class RegisterationController extends Controller
{
    public function store(Request $request){
        $chefController = app('App\Http\Controllers\ChefController');
        $chef = $chefController->store($request);
        // dd($chef);
        $addressData = $request->only('district_id');
        // $data['user_id'] = $chef->id;
        $request['user_id']= $chef['id'];
        // dd($request);
        $addressController = app('App\Http\Controllers\AddressController');
        $address = $addressController->store($request);
        dd($address);
        return $chef;
        
    }
}
