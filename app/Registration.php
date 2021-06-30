<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bvn',
        'title',
        'firstname',
        'lastname',
        'email',
        'phone',
        'marital_status',
        'depandants',
        'education',
        'referee',
        'referal_code',
        'resident_state',
        'house_address',
        'lga',
        'fullname',
        'relationship',
        'kin_phone',
        'kin_email',
        'info',
        'employers_name',
        'employers_startdate',
        'monthly_income',
        'employers_loan_repayment',
        'employers_loan_amount',
        'employers_email',
        'employers_loan_tenure',
        'staff_id_card',
        'employers_address',
        'loan_amount',
        'loan_tenure',
        'bank_name',
        'bank_account_number',
        'bank_account_type',
        'ticket_id',
        'password',
        'user_code',
        'bank_statement' ];  


   public function user() {
        return  $this->belongsTo('App\User','id');
    }



         }
