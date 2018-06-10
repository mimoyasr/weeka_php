<?php

namespace App\Http\Controllers;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ret = [] ;
        $total = $this->user->reduce(function ($carry, $item) {
            return $carry + count($item->inqueryItems);
        });

        $ret['total'] = $total;

        return response()->json($ret);

    }

}
