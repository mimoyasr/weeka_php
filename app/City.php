<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'country_id'
    ];



    public function country(){

        return $this->belongsTo(Country::class);
    }

    
    public function addresses(){
        
        return $this->hasMany(Address::class);
     }

     public function districts(){
        
        return $this->hasMany(District::class);
     }



}
