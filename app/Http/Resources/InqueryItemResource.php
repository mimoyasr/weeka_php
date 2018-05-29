<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InqueryItemResource extends JsonResource
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
            'inquery_id' => $this->inquery_id,
            'meal' => new MealResource($this->meal),
            'telephone' => new TelephoneResource($this->telephone),
            'address' => new AddressResource($this->address),
            'price' => $this->price,
            'quantity' => $this->quantity
        ];
    }
}
