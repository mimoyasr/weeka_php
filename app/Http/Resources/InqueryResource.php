<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InqueryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // 'user_id',
        // 'telephone_id',
        // 'address_id',
        // 'payment_id',
        // 'additional_cost',
        // 'state'
        return [
            'client' => new ClientResource($this->client),
            'meal' => new MealResource($this->meal),
            'telephone' => new TelephoneResource($this->telephone),
            'address' => new AddressResource($this->address),
            'price' => $this->price,
            'quantity' => $this->quantity
        ];
    }
}
