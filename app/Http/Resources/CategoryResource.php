<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cat = [] ;
        $cat['id'] = $this->id;
        $cat['name'] = $this->name;
        if(!empty($this->meals)){
            $cat['meals'] = MealResource::collection($this->meals);
        }
        return $cat;
    }
}
