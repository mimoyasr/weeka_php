<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use App\User;

class ClientController extends Controller
{
    

    
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $destinationPath = public_path('uploads');
            if (!$image->move($destinationPath, $filename)) {
                return json_encode([
                    'Error' => 'Error saving the profile image',
                ]);
            }
        }
        $data['password'] = bcrypt($request->password);
        $data['type'] = 'client';
        $client = User::create($data);
        return new ClientResource($client);        
    }

  
    public function show(User $client)
    {
        return new ClientResource($client);
    }


    
    public function update(Request $request, User $client)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = $filename;
            $destinationPath = public_path('uploads');
            if (!$image->move($destinationPath, $filename)) {
                return json_encode(['Error' => 'Error saving the profile image']);
            }
        }
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $client->update($data);
        return new ClientResource($client);
    }

    public function destroy(User $client)
    {
        return json_encode(["status"=>$client->delete()]);
    }
}
