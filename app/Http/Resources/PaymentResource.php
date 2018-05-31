<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        $data['user_id'] = $this->user_id;
        $data['type'] = $this->type;
        if( $this->type != 'Cash'){
            $data['card'] = [
                'number' => $this->cord_no,
                'exp' => $this->exp,
                'cvv' => $this->cvv,
                'holder' => $this->card_holder_name,
            ] ;
        }
        return $data;
    }
}
