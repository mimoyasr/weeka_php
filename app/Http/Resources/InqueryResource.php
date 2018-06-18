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
            'id' => $this->id,
            'client' => new ClientResource($this->user),
            'additional_cost' => $this->additional_cost,
            'state' => $this->state,
            'items' => InqueryItemResource::collection($this->inqueryItems)
        ];
        if($this->telephone_id == null){
            $data['telephone'] = new TelephoneResource($this->telephone);
        }
        if($this->address_id == null){
            $data['address'] = new AddressResource($this->address);
        }
        if($this->payment_id == null){
            $data['payment'] = new PaymentResource($this->payment);
        }
        if($this->state == -1){
            $data['at'] = $this->at;
        }
        return $data;
    }
}
