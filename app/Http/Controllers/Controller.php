<?php

namespace App\Http\Controllers;


use \JWTAuth as Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::getToken())
        $this->user = Auth::toUser(Auth::getToken());
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
