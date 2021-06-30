<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
        //


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable= [
        'amount', 'tenure', 'interest','total','investment_id','user_id','status','rate','payment_method','file'
    ];



     public function user() {
        return $this->belongTo('App\User','id');
    }

     public function registration() {
        return $this->belongTo('App\Registration','user_id');
    }
}
