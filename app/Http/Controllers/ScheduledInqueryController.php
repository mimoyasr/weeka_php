<?php

namespace App\Http\Controllers;

use App\User;
use App\Inquery;
use App\Http\Resources\InqueryResource;

class ScheduledInqueryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InqueryResource::collection($this->user->schedules);
    }
}
