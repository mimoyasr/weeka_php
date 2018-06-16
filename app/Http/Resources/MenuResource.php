<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'chef_name' => "{$this->chef->fname}  {$this->chef->lname}",
            'chef_id' => $this->chef->id,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'price' => $this->price,
            'preparation_time' => $this->preparation_time,
            'slug' => $this->slug,
            'description' => $this->desc,
            'rate' => $this->rate,
            'state' => $this->state ? true : false,
            'comment_state' => $this->commentState ? true : false,
            'fav' => $this->fav ? true : false,
            'district_id' => $this->chef->addresses[0]->district->id,
            'district_slug' => $this->chef->addresses[0]->district->slug,
            'numbers_of_orders' => count($this->inqueryItems),
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
