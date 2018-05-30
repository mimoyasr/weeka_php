<?php

namespace App\Http\Controllers;
use App\Http\Resources\WorkingHoursResource;
use App\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    
    public function index()
    {
        $data=WorkingHour::all();
        return WorkingHoursResource::collection($data);
    }


    public function store(Request $request)
    {
       $data=$request->all();
       $workhours=WorkingHour::create($data);
       return new WorkingHoursResource($workhours);
    }

 
    public function update(Request $request, WorkingHour  $workingHour)
    {
        $data=$request->all();
        $workingHour->update($data);
        return new WorkingHoursResource($workingHour); 
    }

    public function destroy(WorkingHour $workingHour)
    {
       return json_encode(['status'=> $workingHour->delete()]);
    }
}
