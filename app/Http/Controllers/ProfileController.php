<?php

namespace App\Http\Controllers;

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
        return $this->user->type == 'chef' ? new ChefResource($this->user) : new ClientResource($this->user);
    }
}
