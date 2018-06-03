<?php

namespace App\Http\Controllers;

use App\User;
use App\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = User::find(2);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PaymentResource::collection($this->user->payments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $data['user_id'] = $this->user->id;
        $payment = Payment::create($data);
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $meal->update($data);
        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        return json_encode(['status'=> $payment->delete()]);
    }

    private function _validation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3|max:10',
            'type' => 'required|in:Cash,Credit Card',
            'card_no' => 'required|digits:15',
            'exp' =>'required|digits:4',
            'cvv' => 'required|digits:4',
            'card_holder_name' => 'required|string|min:3|max:20'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;
    }
}
