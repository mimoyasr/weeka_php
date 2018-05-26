<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'country_id',
        'city_id',
        'district_id',
        'street',
        'buildingno',
        'floorno',
        'flatno',
        'notice'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function inquery_items(){
        return $this->hasMany(Inquery_item::class);
    }
      public function inqueries(){
        return $this->hasMany(Inquery::class);
    }
}
