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
            'number' => $this->number,
            'user_id' => new ClientResource($this->user),
            'is active'=> $this->isactive,
            'provider_id'=> new ProviderResource($this->Provider)
        ];
    }
}
