<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_log extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'amount','transaction_type','user_id','mandate_id'
    ];



     public function user() {
        return $this->belongTo('App\User','user_id');
    }

}
