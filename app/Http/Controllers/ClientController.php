<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class ClientController extends Controller
{
    

    
    public function store(Request $request)
    {
        $data = $request->except('id', 'type', 'state', 'desc') ;;
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
            $data['type'] = 'client';
            $client= User::create($data);
            return new ClientResource($client);         
        }else {
           return $validation ;
        }       
    }

  
    public function show(User $client)
    {
        return new ClientResource($client);
    }


    
    public function update(Request $request, User $client)
    {
        $data = $request->except('id', 'type', 'state', 'desc') ;
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
        
        $validation= $this->_validationUpdate($data,$client);
        if( $validation === true){
            if($request->password){
                $data['password'] = bcrypt($request->password);
            }
            $client->update($data);
            return new ClientResource($client);       
        }else {
           return $validation ;
        }
    }

    public function destroy(User $client)
    {
        return json_encode(["status"=>$client->delete()]);
    }

    private function _validationStore($data){

        $validator = Validator::make($data, [
            'fname' => 'required|max:25',
            'lname' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:6|max:32',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors(), 422);
        }else {
            return true;
        }
    }

    private function _validationUpdate($data , $client ){

        $validator = Validator::make($data, [
                'fname' => 'max:25',
                'lname' => 'max:25',
                'email' => [Rule::unique('users')->ignore($client->id),'string','email'],
                'gender' => 'exists:users,gender',
                'password' => 'string|min:6|max:32',
         
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors(), 422);
        }else {
            return true;
        }
    }

}

