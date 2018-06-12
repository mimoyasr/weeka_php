<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class District extends Model
{
   
    protected $fillable = [
        'name',
        'city_id'
    ];


    public function city(){
        return $this->belongsTo(City::class);
    }


    public function addresses(){
        
        return $this->hasMany(Address::class);
     }
}
