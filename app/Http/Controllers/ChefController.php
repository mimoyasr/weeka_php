<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Resources\ChefResource;
use App\Telephone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\ChefProfileResource;

class ChefController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth')->only(['update', 'destroy']);
    }

    public function store(Request $request)
    {
        $data = $request->except('id', 'image');
        $validation = $this->_validationStore($data);
        if ($validation === true) {
            $data['password'] = bcrypt($request->password);
            $data['type'] = 'chef';
            $chef = User::create($data);
            $addressData = [];
            $addressData['user_id'] = $chef->id;
            $addressData['district_id'] = $request->district_id;
            $address = Address::create($addressData);
            $telephoneData = [];
            $telephoneData['user_id'] = $chef->id;
            $telephoneData['provider_id'] = $request->provider_id;
            $telephoneData['number'] = $request->number;
            $telephone = Telephone::create($telephoneData);
            return new ChefResource($chef);
        } else {
            return $validation;
        }
    }

    public function show(User $chef)
    {
        $numOfOrders = $chef->meals->reduce(function ($carry, $meal) {
            return $carry + count($meal->inqueryItems);
        });
        $rate = $chef->meals->reduce(function ($carry, $meal) {
            return $carry + $meal->rate;
        }) / count($chef->meals);
        $chef['no_of_orders'] = $numOfOrders;
        $chef['rate'] = $rate;
        return new ChefProfileResource($chef);
    }

    public function update(User $chef, Request $request)
    {
        $data = $request->except('id', 'type');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $destinationPath = public_path('uploads');
            if (!in_array($image->getClientOriginalExtension(), ['jpg', 'png', 'jpeg'])) {
                return response()->json(['message' => 'The image format must be jpg , png , jpeg'], 422);
            }
            if (!$image->move($destinationPath, $filename)) {
                return response()->json(['message' => 'Error saving the profile image'], 422);
            }
        }

        $validation = $this->_validationUpdate($data, $chef);
        if ($validation === true) {
            if ($request->password) {
                if ($request->old_password) {
                    if (password_verify($request->old_password, $chef->password)) {
                        $data['password'] = bcrypt($request->password);
                        $chef->update($data);
                        return response()->json(['message' => 'password changed.']);
                    } else {
                        return response()->json(['old_password' => 'Old password is invalid.'], 422);
                    }
                } else {
                    return response()->json(['old_password' => 'Old password is required.'], 422);
                }
            }

            $chef->update($data);
            return new ChefResource($chef);
        } else {
            return $validation;
        }
    }

    public function destroy(User $chef)
    {
        return json_encode([
            "status" => $chef->delete(),
        ]);
    }

    private function _validationStore($data)
    {
        $validator = Validator::make($data, [
            'fname' => 'required|max:25',
            'lname' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:male,female',
            'district_id' => 'required|exists:districts,id',
            'provider_id' => 'required|exists:providers,id',
            'number' => ['required', 'numeric',
                Rule::unique('telephones')->where(function ($query) use ($data) {
                    return $query->where('provider_id', $data['provider_id']);
                })],
            'password' => 'required|string|min:6|max:32',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            return true;
        }
    }

    private function _validationUpdate($data, $chef)
    {
        $validator = Validator::make($data, [
            'fname' => 'max:25',
            'lname' => 'max:25',
            'email' => [Rule::unique('users')->ignore($chef->id), 'string', 'email'],
            'gender' => 'exists:users,gender',
            'password' => 'string|min:6|max:32',
            'desc' => 'min:10|max:255',
            'state' => 'exists:users,state',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            return true;
        }
    }
}
