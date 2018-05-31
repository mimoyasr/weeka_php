<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'chef_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
    // return $this->belongsTo('App\User','id','manager_id');
    public function chef()
    {
        return $this->belongsTo(User::class,'id','chef_id');
    }
}
