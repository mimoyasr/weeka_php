<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
   public function favs(){
       return $this->hasMany(Fav::class);
   }

   public function inquery_items(){
    return $this->hasMany(Inquery_item::class);
}

}
