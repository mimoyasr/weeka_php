<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

   
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

    public function addresses(){
        
       return $this->hasMany(Address::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function inqueries(){
        return $this->hasMany(Inquery::class);
    }

    public function getSchedulesAttribute()
    {
        return $this->inqueries->reject(function ($inquery) {
            return $inquery->state != -1;
        });
    }

    public function subscribers(){
        return $this->hasMany(Subscribe::class, 'chef_id', 'id');
    }
}
