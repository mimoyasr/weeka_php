<?php

namespace App\Http\Controllers;
use App\Http\Resources\WorkingHoursResource;
use App\Working_hour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    
    public function index()
    {
        $data=Working_hour::all();
        return WorkingHoursResource::collection($data);
    }


    public function store(Request $request)
    {
       $data=$request->all();
       $workhours=Working_hour::create($data);
       return new WorkingHoursResource($workhours);
    }

 
    public function update(Request $request,  $id)
    {
        $workhour = Working_hour::find($id);
        $data=$request->all();
        $workhour->update($data);
        return new WorkingHoursResource($workhour); 
    }

    public function destroy($id)
    {
       return json_encode(['status'=>Working_hour::find($id)->delete()]);
    }
}
