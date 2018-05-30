<?php

namespace App\Http\Controllers;

use App\Http\Resources\InqueryItemResource;
use App\Inquery;
use App\InqueryItem;
use Illuminate\Http\Request;

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
        $data = $request->all();
        $data['inquery_id'] = $inquery->id;
        $inqueryItem = InqueryItem::create($data);
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
        $inqueryItem = InqueryItem::find($inqueryItem_id);
        if ($inqueryItem) {
            return new InqueryItemResource($inqueryItem);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
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
        if ($inqueryItem) {
            $data = $request->all();
            $inqueryItem->update($data);
            return new InqueryItemResource($inqueryItem);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        } 
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
        if ($inqueryItem) {
            return response()->json(['status' => $inqueryItem->delete()]);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}
