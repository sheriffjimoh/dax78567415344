<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_wallet extends Model
{
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'balance','user_id','user_type','investor_balance','status'
    ];



     public function user() {
        return $this->belongTo('App\User','id');
    }
}
