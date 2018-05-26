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
        return $this->belongsTo(User::class);
    }

    public function chef()
    {
        return $this->belongsTo(User::class);
    }
}
