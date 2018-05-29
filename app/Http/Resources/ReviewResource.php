<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
        'user_id'=> new ClientResource($this->user), 
        'meal_id' => $this->meal_id,
        'comment' => $this->comment,
        'rate' => $this->rate,
        ];
    }
}
