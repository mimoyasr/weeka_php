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
            'id' => $this->id,
            'name' => $this->name,
            // 'chef' => new ChefResource($this->chef),
            'chef_name' => $this->chef->fullname,
            'chef_id' => $this->chef->id,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'preparation_time' => $this->preparation_time,
            'slug' => $this->slug,
            'description' => $this->desc,
            // 'reviews' => ReviewResource::collection($this->reviews),
            'average' => $this->average
        ];
    }
}
