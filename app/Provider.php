<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
   
    protected $fillable = [
        'name',
        'prefix',
    ];

    public function providers(){
        return $this->hasMany(Provider::class);
    }
}
