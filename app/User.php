<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addresses(){
        
       return $this->hasMany(Address::class);
    }

    public function inqueries(){
        return $this->hasMany(Inquery::class);
    }
}
