<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country'=> $this->country->name,
            'city' => $this->city->name,
            'district' => $this->district->name,
            'street no' => $this->street,
            'building no' => $this->buildingno,
            'flatno' => $this->flatno,
            'floorno' => $this->floorno,
            'notice' =>$this->notice
           
        ];
    }
}
