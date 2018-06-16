<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'gender' => $this->gender == 'male' ? 'ذكر' : 'انثي',
            'email' => $this->email,
            'image' => $this->image,
            'type' => $this->type,
            'telephones' => TelephoneResource::collection($this->telephones),
            'addresses' => AddressResource::collection($this->addresses),
            'inqueries' => InqueryResource::collection($this->inqueries),
            'favs' => FavResource::collection($this->favs)
        ];

    }
}
