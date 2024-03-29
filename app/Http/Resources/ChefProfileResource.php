<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChefProfileResource extends JsonResource
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
            'fname' => $this->fname,
            'lname' => $this->lname,
            'name' => $this->fullname,
            'gender' => $this->gender == 'male' ? 'ذكر' : 'انثي',
            'image' => $this->image , 
            'description' => $this->desc,
            'no_of_orders' => $this->no_of_orders,
            'rate' => $this->rate,
            'working_hours' => WorkingHoursResource::collection($this->workinghours),
            'menu' => MealResource::collection($this->meals)
        ];
    }
}
