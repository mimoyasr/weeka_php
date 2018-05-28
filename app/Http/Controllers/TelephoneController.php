<?php

namespace App\Http\Controllers;

use App\Telephone;
use App\Http\Resources\TelephoneResource;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
  
  
    public function store(Request $request)
    {
        $data= $request->all();
        $tel=Telephone::create($data);
        return new TelephoneResource($tel);
    }

  
    public function show(Telephone $telephone)
    {
        return new TelephoneResource($telephone);
    }

    public function update(Request $request, Telephone $tel)
    {
        $data= $request->all();
        $tel->update($data);
        return new TelephoneResource($tel);
    }


    public function destroy(Telephone $tel)
    {
        return json_encode(['status'=> $tel->delete()]);
    }
}
