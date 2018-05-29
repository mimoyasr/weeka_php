<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
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
            'name' => $this->name,
            'chef' => new ChefResource($this->chef),
            'image' => $this->image,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'prepartion_time' => $this->prepartion_time,
            'description' => $this->desc,
            'review'=> ReviewResource::collection($this->reviews),
      
        ];
    }
}
