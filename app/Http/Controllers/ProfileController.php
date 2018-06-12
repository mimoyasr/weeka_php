<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ChefResource;
use App\Http\Resources\ClientResource;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->user->type == 'chef'){
            return new ChefResource($this->user);
        }else{
            return new ClientResource($this->user);
        }
    }

}
