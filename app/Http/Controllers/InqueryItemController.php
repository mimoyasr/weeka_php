<?php

namespace App\Http\Controllers;

use App\Inquery;
use App\InqueryItem;
use Illuminate\Http\Request;
use App\Http\Resources\InqueryItemResource;

class InqueryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inquery $inquery)
    {
        return InqueryItemResource::collection($inquery->inqueryItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Inquery  $inquery
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Inquery $inquery, Request $request)
    {
        $data=$request->all();
        $data['inquery_id'] = $inquery->id;
        $inqueryItem= InqueryItem::create($data);
        return new InqueryItemResource($inqueryItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inquery  $Inquery
     * @param  \App\InqueryItem  $InqueryItem
     * @return \Illuminate\Http\Response
     */
    // public function show(Inquery $inquery, InqueryItem $inqueryItem)
    public function show(Inquery $inquery, $inqueryItem_id)
    {
        return new InqueryItemResource(InqueryItem::find($inqueryItem_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inquery  $inquery
     * @param  int $InqueryItem_id
     * @return \Illuminate\Http\Response
     */
    public function update(Inquery $inquery, int $inqueryItem_id, Request $request)
    {
        $inqueryItem = InqueryItem::find($inqueryItem_id);
        $data=$request->all();
        $inqueryItem->update($data);
        return new InqueryItemResource($inqueryItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inquery  $inquery
     * @param  int $InqueryItem_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquery $inquery, int $inqueryItem_id)
    {
        $inqueryItem = InqueryItem::find($inqueryItem_id);
        return json_encode(['status'=> $inqueryItem->delete()]);
    }
}
