<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan_repayment extends Model
{
  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'repayment_amount','total_repayment', 'loan_tenure','repayment_date','loan_id','user_id','user_code','status','mandate_id'
    ];



     public function user() {
        return $this->belongTo('App\User','id');
    }
}
