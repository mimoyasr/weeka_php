<?php

namespace App\Http\Resources;
use carbon;

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
        'username'=> "{$this->user->fname} {$this->user->lname}",
        'image'  => $this->user->image,
        'user_id' => $this->user->id,
        'meal_id' => $this->meal_id,
        'comment' => $this->comment,
        'rate' => $this->rate,
        'date'=> carbon\Carbon::parse($this->created_at)->format('d/m/y'),
        'time'=> carbon\Carbon::parse($this->created_at)->format(' h:i A')

        ];
    }
}
