<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChefResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
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
            'gender' => $this->gender == 'male' ? 'ذكر' : 'انثي',
            'email' => $this->email,
            'image' => $this->image,
            'description' => $this->desc,
            'state' => $this->state,
            'telephones' => TelephoneResource::collection($this->telephones),
            'addresses' => AddressResource::collection($this->addresses),
            'working_hours' => WorkingHoursResource::collection($this->workinghours),
            'meals' => MealResource::collection($this->meals)
        ];
    }
}
