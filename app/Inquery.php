<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquery extends Model
{
    protected $fillable = [
        'user_id',
        'telephone_id',
        'address_id',
        'payment_id',
        'additional_cost',
        'state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function telephone(){

        return $this->belongsTo(Telephone::class);
    }

    public function address(){

        return $this->belongsTo(Address::class);
    }

    public function payment(){

        return $this->belongsTo(Payment::class);
    }

    public function inqueryItems(){
        return $this->hasMany(InqueryItem::class);
    }

    public function scheduleds()
    {
        return $this->hasMany(Scheduled_inquery::class);
    }
}
