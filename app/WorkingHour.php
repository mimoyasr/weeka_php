<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chef_id',
        'day',
        'from_hour',
        'from_min',
        'from_period',
        'to_hour',
        'to_min',
        'to_period',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
