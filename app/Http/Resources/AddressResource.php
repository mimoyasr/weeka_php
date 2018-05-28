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
            'country'=> new CountryResource($this->country),
            'city' => new CityResource($this->city),
            'district' => new DistrictResource($this->district),
            'street no' => $this->street,
            'building no' => $this->buildingno
        ];
    }
}
