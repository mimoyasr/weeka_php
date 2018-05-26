<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Working_hour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
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
