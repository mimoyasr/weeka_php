<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  
    protected $fillable = [
        'name' ];

    
    public function addresses(){
        
        return $this->hasMany(Address::class);
     }
     
    public function cities(){
        return $this->hasMany(City::class);
    }
}
