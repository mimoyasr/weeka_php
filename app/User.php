<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'gender',
        'image',
        'password',
        'type',
        'desc',
        'state',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function telephones()
    {
        return $this->hasMany(Telephone::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function inqueries()
    {
        return $this->hasMany(Inquery::class);
    }

    public function getSchedulesAttribute()
    {
        return $this->inqueries->reject(function ($inquery) {
            return $inquery->state != -1;
        });
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribe::class, 'chef_id', 'id');
    }

    public function getFullnameAttribute() {
        return "{$this->fname} {$this->lname}";
    }

    public function workinghours() {
        return $this->hasMany(WorkingHour::class);
    }

    public function meals() {
        return $this->hasMany(Meal::class,'chef_id','id');
    }

    public function favs() {
        return $this->hasMany(Fav::class);
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
                'source' => 'fullname',
            ],
        ];
    }
}
