<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 
        'isactive',
        'user_id',
        'provider_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function inqueries(){
        return $this->hasMany(Inquery::class);
    }
    
    public function inquery_items(){
        return $this->hasMany(Inquery_item::class);
    }
}
