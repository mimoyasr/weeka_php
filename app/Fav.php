<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    protected $fillable = [
        'user_id',
        'meal_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function meal(){

        return $this->belongsTo(Meal::class);
    }
}
