<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkingHoursResource;
use App\User;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkingHourController extends Controller
{

    public function index()
    {
        $data = WorkingHour::all();
        return WorkingHoursResource::collection($data);
    }

    public function store(Request $request)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $data['user_id'] = $this->user->id;
        $workhours = WorkingHour::create($data);
        return new WorkingHoursResource($workhours);
    }

    public function update(Request $request, WorkingHour $workingHour)
    {
        $data = $request->except('id', 'user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $workingHour->update($data);
        return new WorkingHoursResource($workingHour);
    }

    public function destroy(WorkingHour $workingHour)
    {
        return response()->json(['status' => $workingHour->delete()]);
    }

    private function _validation($data)
    {
        $validator = Validator::make($data, [
            'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'from_hour' => 'required|integer|between:0,12',
            'from_min' => 'required|integer|between:0,60',
            'from_period' => 'required|in:AM,PM',
            'to_hour' => 'required|integer|between:0,12',
            'to_min' => 'required|integer|between:0,60',
            'to_period' => 'required|in:AM,PM',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;
    }
}
