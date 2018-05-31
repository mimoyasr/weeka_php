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
        $data = [
            'client' => new ClientResource($this->user),
            'telephone' => new TelephoneResource($this->telephone),
            'address' => new AddressResource($this->address),
            'payment' => new PaymentResource($this->payment),
            'additional_cost' => $this->additional_cost,
            'state' => $this->state,
            'items' => InqueryItemResource::collection($this->inqueryItems)
        ];
        if($this->state == -1){
            $data['at'] = $this->at;
        }
        return $data;
    }
}
