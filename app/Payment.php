<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id', 
        'type',
        'card_no',
        'exp',
        'cvv',
        'card_holder_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
