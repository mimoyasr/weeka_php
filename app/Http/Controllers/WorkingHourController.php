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

 
    public function update(Request $request,  $id)
    {
        $workhour = WorkingHour::find($id);
        $data=$request->all();
        $workhour->update($data);
        return new WorkingHoursResource($workhour); 
    }

    public function destroy($id)
    {
       return json_encode(['status'=>WorkingHour::find($id)->delete()]);
    }
}
