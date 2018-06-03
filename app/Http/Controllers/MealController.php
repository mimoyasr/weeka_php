<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Review;
use App\Http\Resources\MealResource;
use Illuminate\Http\Request;

class MealController extends Controller
{   
    //TODO meal name must be unique
    public function store(Request $request)
    {

        $data = $request->except('id');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $destinationPath = public_path('uploads');
            if( ! in_array($image->getClientOriginalExtension(),['jpg','png','jpeg'])){
                return response()->json(['message' => 'The image format must be jpg , png , jpeg'], 422);
            }
            if (!$image->move($destinationPath, $filename)) {
                return response()->json(['message' => 'Error saving the profile image'], 422);

            }
        }
        $validation= $this->_validation($data);
        if( $validation === true){

            $meal= Meal::create($data);
            return new MealResource($meal);         
        }else {
           return $validation ;
        } 
    }

   
    public function show(Meal $meal)
    {
        return new MealResource($meal);
    }

     
    public function update(Request $request, Meal $meal)
    {
        $data = $request->except('id') ;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $destinationPath = public_path('uploads');
            if( ! in_array($image->getClientOriginalExtension(),['jpg','png','jpeg'])){
                return response()->json(['message' => 'The image format must be jpg , png , jpeg'], 422);
            }
            if (!$image->move($destinationPath, $filename)) {
                return response()->json(['message' => 'Error saving the profile image'], 422);
            }
        }   
        
        $validation= $this->_validation($data);
        if( $validation === true){
            $meal->update($data);
            return new MealResource($meal);      
        }else {
           return $validation ;
        }
       
    }

    public function destroy(Meal $meal)
    {
        return json_encode(['status'=> $meal->delete()]);

    }


    private function _validation($data)
    {

        $validator = Validator::make($data, [

            'name' => 'required|string|min:2|max:10',
            'chef_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1|max:6',
            'preparation_time' => 'required|numeric',
            'description' => 'required|string',
            
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return true;

    }


}
