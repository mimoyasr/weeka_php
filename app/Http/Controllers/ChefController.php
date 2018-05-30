<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChefResource;
use App\User;
use Illuminate\Http\Request;

class ChefController extends Controller
{

    public function index()
    {
        $Chefs = User::where('type', 'chef')->orderBy('fname', 'asc')->get();
        return ChefResource::collection($Chefs);
    }

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
        $data['type'] = 'chef';
        $chef = User::create($data);
        return new ChefResource($chef);
    }

    public function show(User $chef)
    {
        return new ChefResource($chef);
    }

    public function update(Request $request, User $chef)
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
        $chef->update($data);
        return new ChefResource($chef);
    }

    public function destroy(User $chef)
    {
        return json_encode([
            "status" => $chef->delete(),
        ]);
    }
}
