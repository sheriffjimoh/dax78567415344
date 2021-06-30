<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet_transact extends Model
{
    //

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','amount','available_balance','transaction_type','investor_id'
    ];

 public function user() {
        return  $this->belongsTo('App\User','id');
    }


}
