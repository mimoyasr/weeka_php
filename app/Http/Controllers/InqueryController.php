<?php

namespace App\Http\Controllers;

use App\Http\Resources\InqueryResource;
use App\Inquery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//بعد الحساب
class InqueryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Inqueries = Inquery::where('user_id', $this->user->id)->orderBy('id', 'asc')->get();
        return InqueryResource::collection($Inqueries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data['user_id'] = $this->user->id;
        $inquery = Inquery::create($data);
        return new InqueryResource($inquery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function show(Inquery $inquery)
    {
        return new InqueryResource($inquery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquery $inquery)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation === true) {
            $inquery->update($data);
            return new InqueryResource($inquery);
        } else {
            return $validation;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inquery  $inquery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquery $inquery)
    {
        return json_encode(['status' => $address->delete()]);
    }

    private function _validation($data)
    {
        $validator = Validator::make($data, [
            'telephone_id' => 'exists:telephones,id',
            'address_id' => 'exists:addresses,id',
            'payment_id' => 'exists:payments,id',
            'state' => 'integer|betweeen:-1,0']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;
    }

    private function _validationUpdate($data)
    {
        $validator = Validator::make($data, [
            'telephone_id' => 'required|exists:telephones,id',
            'address_id' => 'required|exists:addresses,id',
            'payment_id' => 'required|exists:payments,id',
            'state' => 'integer|betweeen:-1,0']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;
    }
}
