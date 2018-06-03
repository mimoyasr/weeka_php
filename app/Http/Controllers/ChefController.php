<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChefResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

class ChefController extends Controller
{

    public function index()
    {
        $Chefs = User::where('type', 'chef')->orderBy('fname', 'asc')->get();
        return ChefResource::collection($Chefs);
    }

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
        $validation= $this->_validationStore($data);
        if( $validation === true){

            $data['password'] = bcrypt($request->password);
            $data['type'] = 'chef';
            $chef= User::create($data);
            return new ChefResource($chef);         
        }else {
           return $validation ;
        }
        
        
    }

    public function show(User $chef)
    {
        return new ChefResource($chef);
    }

    public function update(User $chef, Request $request)
    {   
        $data = $request->except('id', 'type') ;
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
        
        $validation= $this->_validationUpdate($data,$chef);
        if( $validation === true){
            if($request->password){
                $data['password'] = bcrypt($request->password);
            }
            $chef->update($data);
            return new ChefResource($chef);       
        }else {
           return $validation ;
        }
        
       
    }

    public function destroy(User $chef)
    {
        return json_encode([
            "status" => $chef->delete(),
        ]);
    }

    private function _validationStore($data){

        $validator = Validator::make($data, [
            'fname' => 'required|max:25',
            'lname' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'gender' => 'required|exists:users,gender',
            'password' => 'required|string|min:6|max:32',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors(), 422);
        }else {
            return true;
        }
    }

    private function _validationUpdate($data , $chef ){

        $validator = Validator::make($data, [
                'fname' => 'max:25',
                'lname' => 'max:25',
                'email' => [Rule::unique('users')->ignore($chef->id),'string','email','max:255'],
                'gender' => 'exists:users,gender',
                'password' => 'string|min:6|max:32',
                'desc' => 'min:10|max:255',
                'state' => 'exists:users,state'
         
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors(), 422);
        }else {
            return true;
        }
    }

}
