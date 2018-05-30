<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InqueryItem extends Model
{

    protected $fillable = [
        'meal_id',
        'inquery_id',
        'telephone_id',
        'address_id',
        'price',
        'quantity'
    ];


    public function meal(){

        return $this->belongsTo(Meal::class);
    }

    public function inquery(){

        return $this->belongsTo(Inquery::class);
    }

    public function telephone(){

        return $this->belongsTo(Telephone::class);
    }

    public function address(){

        return $this->belongsTo(Address::class);
    }

}
