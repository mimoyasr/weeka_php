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
        // $inquryItems = InqueryItem::where('inquery_id',$inquery->id);
        // return InqueryItemResource::collection($inqueryItems);
        return InqueryItemResource::collection($inquery->inqueryItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Inquery  $inquerycle
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Inquery $inquery, Request $request)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
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
            $data = $request->except('id', 'user_id');
            $validation = $this->_validation($data);
            if ($validation !== true) {
                return $validation;
            }
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

    private function _validation($data)
    {

        $validator = Validator::make($data, [

            'meal_id' => 'required|exists:meals,id',
            'telephone_id' => 'required|exists:telephones,id',
            'address_id' => 'required|exists:addresses,id',
            'inquery_id' => 'required|exists:inqueries,id',
            'price' => 'required|numeric|min:1|max:6',
            // check no
            'quantity' => 'required|integer']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;

    }

}
