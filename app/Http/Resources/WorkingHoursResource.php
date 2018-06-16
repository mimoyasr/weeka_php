<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'chef_id'=> $this->user_id,
            'day' => $this->day,
            'from_hour'=> $this->from_hour,
            'from_min'=> $this->from_min,
            'from_period'=> $this->from_period,
            'to_hour' =>$this->to_hour,
            'to_min' =>$this->to_min,
            'to_period' =>$this->to_period,
        ];
    }
}
