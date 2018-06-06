<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TelephoneResource extends JsonResource
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
            'number' => $this->number,
            'is active'=> $this->isactive,
            'provider_id'=> new ProviderResource($this->Provider)
        ];
    }
}
