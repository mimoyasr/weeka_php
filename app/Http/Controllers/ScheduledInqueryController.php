<?php

namespace App\Http\Controllers;

use App\User;
use App\Inquery;
use App\Http\Resources\InqueryResource;

class ScheduledInqueryController extends Controller
{

    private $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->user = Auth->user();
        $this->user = User::find(2);
    }

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
