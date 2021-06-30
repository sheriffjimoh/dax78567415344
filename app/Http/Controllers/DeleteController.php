<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet_transact;
use App\User;
use App\Registration;
use App\Loan_repayment;
use App\Loan;
use App\Transaction_log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\UserCredencials;
use Session;
use Validator;
use App\Mail\LoanMail;

class DeleteController extends Controller
{
    //



           public function delete_loan($value)
           {
            
            $getloan = Loan::where('id', $value)->first();
             if ($getloan->status == 'approved') {
             $checkrepayment = Loan_repayment::where('loan_id',$getloan->loan_id)->get();
              if (count($checkrepayment) > 0) {
               DB::table('loan_repayments')->where('loan_id', $getloan->loan_id)->delete();
              }
                }
           $deleteloan = DB::table('loans')->where('id', $value)->delete();
              if ($deleteloan) {
                return  redirect('/loan-list/')->with('success', 'loan successfully deleted');

              
             }
          }

           

         

           public function delete_wallet($value)
           {
            
             $deletewallet = DB::table('wallet_transacts')->where('id', $value)->delete();
              if ($deletewallet) {
                return  redirect('/loan-wallet')->with('success', 'wallet transaction successfully deleted');
             }
          }

          public function delete_customer($value)
           {
            
             $deletewallet = DB::table('users')->where('id', $value)->delete();
              if ($deletewallet) {
              	DB::table('registrations')->where('id', $value)->delete();
              	DB::table('loans')->where('id', $value)->delete();
              	DB::table('loan_repayments')->where('id', $value)->delete();
                return  redirect('/all-customer')->with('success', 'customer record  successfully deleted');
             }
          }



          public function delete_transact($value)
          {
             $delete_transact_log = DB::table('transaction_logs')->where('id', $value)->delete();
              if ($delete_transact_log) {
                
                return  redirect('/transaction_logs')->with('success', ' transaction log successfully deleted');
             }else{

                return  redirect('/transaction_logs')->with('error', ' unable to delete record');
             }
          }



            public function investment_application_delete($value)
          {
             $delete_transact_log = DB::table('investments')->where('investment_id', $value)->delete();
              if ($delete_transact_log) {
                
                 return response()->json(['msg'=> 'investment deleted successful', 'status'=>200]);
                }else{

              return response()->json(['msg'=> 'something went wrong', 'status'=>404]);
             }
          }


              public function delete_admin_account($value)
              {
                $delete_acount = DB::table('users')->where('id', $value)->delete();
              if ($delete_acount) {
                
                return  redirect()->back()->with('success', ' record deleted successfull ');
             }else{

                return  redirect()->back()->with('error', ' unable to delete record');
             }
              }

}
