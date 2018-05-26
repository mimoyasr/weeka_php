<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function inqueries(){
        return $this->hasMany(Inquery::class);
    }
}
