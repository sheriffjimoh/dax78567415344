<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable= [
        'loan_amount', 'loan_tenure','loan_repayment_amount','loan_id','user_id','status','loan_doc','remark','customer_reply','mandate_id'
    ];



     public function user() {
        return $this->belongTo('App\User','id');
    }

     public function registration() {
        return $this->belongTo('App\Registration','user_id');
    }

}
