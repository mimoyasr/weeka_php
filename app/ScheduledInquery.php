<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduledInquery extends Model
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
