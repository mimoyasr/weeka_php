<?php

namespace App\Http\Controllers;

use App\Http\Resources\TelephoneResource;
use App\Telephone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TelephoneController extends Controller
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

    public function store(Request $request)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        if (!isset($data['isactive'])) {
            $data['isactive'] = '0';
        }
        $data['user_id'] = $this->user->id;
        $tel = Telephone::create($data);
        return new TelephoneResource($tel);
    }

    public function show(Telephone $telephone)
    {
        return new TelephoneResource($telephone);
    }

    public function update(Request $request, Telephone $telephone)
    {
        $data = $request->all();
        $telephone->update($data);
        return new TelephoneResource($telephone);
    }

    public function destroy(Telephone $telephone)
    {
        return response()->json(['status' => $telephone->delete()]);
    }

    private function _validation($data)
    {
        $validator = Validator::make($data, [
            'provider_id' => 'required|exists:providers,id',
            'number' => ['required', 'digits:8', Rule::unique('telephones')->where(function ($query) use ($data)  {
                return $query->where('provider_id', $data['provider_id']);
            })],
            'isactive' => 'integer|between:0,1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;
    }
}
