<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'chef_id', 
        'category_id',
        'image',
        'perpration_time',
        'price',
        'desc',
    ];

    public function chef()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
   public function favs(){
       return $this->hasMany(Fav::class);
   }

   public function inquery_items(){
    return $this->hasMany(Inquery_item::class);
}

}
