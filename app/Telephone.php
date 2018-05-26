<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    //



    public function inqueries(){
        return $this->hasMany(Inquery::class);
    }

    public function inquery_items(){
        return $this->hasMany(Inquery_item::class);
    }
}
