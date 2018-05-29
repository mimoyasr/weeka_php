<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;
use App\Http\Resources\DistrictResource;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DistrictResource::collection(District::all());
    }

}
