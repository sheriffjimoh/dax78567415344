<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment_portfolio extends Model
{
    //

        protected $fillable= [
    'amount','total_interest','total_repayment','monthly_payment','start_date','end_date','investment_id','user_id','status'
    ];



     public function user() {
        return $this->belongTo('App\User','id');
    }

     public function registration() {
        return $this->belongTo('App\Registration','user_id');
    }
}
