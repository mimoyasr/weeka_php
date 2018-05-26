<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduled_inquery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inquery_id', 
        'at',
    ];

    public function inquery()
    {
        return $this->belongsTo(Inquery::class);
    }
}
