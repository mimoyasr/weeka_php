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
            'meal_id' => $this->id,
            'name' => $this->name,
            'chef_name' => $this->chef->fullname,
            'chef_id' => $this->chef->id,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'price' => $this->price,
            'preparation_time' => $this->preparation_time,
            'slug' => $this->slug,
            'description' => $this->desc,
            'average' => $this->average,
            'no_of_orders' => count($this->inqueryItems),
            'state' => $this->state ? true : false,
            'rate' => $this->rate,
        ];
    }
}
