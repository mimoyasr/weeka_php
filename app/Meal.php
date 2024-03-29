<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Meal extends Model
{
    use Sluggable;

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
        'preparation_time',
        'price',
        'desc',
    ];

    public function chef()
    {
        return $this->belongsTo(User::class,'chef_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function favs()
    {
        return $this->hasMany(Fav::class);
    }

    public function inqueryItems()
    {
        return $this->hasMany(InqueryItem::class);
    }

    public function getRateAttribute()
    {
        return $this->reviews->reduce(function ($carry, $review) {
            return $carry + $review->rate;
        }) / count($this->reviews);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
