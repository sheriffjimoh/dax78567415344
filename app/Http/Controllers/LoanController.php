<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet_transact;
use App\User;
use App\Registration;
use App\Loan_repayment;
use App\Loan;
use App\Customerwallet;
use App\Transaction_log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\UserCredencials;
use Session;
use Validator;
use App\Mail\LoanMail;
use App\Site;
use App\Apimock_up;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoanController extends Controller
{
    



                   public function loan_process(Request  $request )
                   {
                     if ($request->input('status') =='approve') {
                      
                       $user_id = $request->input('user_id');
                      $validator = Validator::make($request->all(), [
                        'loan_amount' => 'required',
                        'loan_tenure' => 'required',
                        'repayment_amount' => 'required',
                        'file' => 'required'
                      ]);

                      if ($validator->fails()) {
                       return  redirect('/user_preview/'.$user_id)->with('errors', $validator->errors());
                      
                       }else{
                

                          if ($request->hasFile('file')) {
                           $filetypeallowed = array('pdf','docx','doc');
                         
                           if (!in_array($request->file->extension(), $filetypeallowed)) {
                          
                           return  redirect('/user_preview/'.$user_id)->with('error', 'only pdf and ms files are allowed');

                            }else{
                              

                              // $checkbal=Wallet_transact::where('transaction_type','loan')->get();
                               $loan_balances = DB::select( DB::raw("SELECT SUM(amount) as balance FROM wallet_transacts WHERE  transaction_type =:type  "), array('type' => 'loan'));

                            foreach ($loan_balances as $loan_balance) { }
                              $available_balance = $loan_balance->balance;

                               if ($request->input('loan_amount') > $available_balance) {
                                $message = 'sorry, you dont have funds up to  ₦'.number_format($request->input('loan_amount'),2) .' to disburst';
                                return  redirect('/user_preview/'.$user_id)->with('error', $message);
                                 }else  {
                                  $time =time();
                                  $date = date('Y-m-d', $time);
                                  $loan_id = $request->input('loan_id');
                                  $transact_id ='Ti'.rand(566767,432344); 
                                  $l_amount =$request->input('loan_amount');
                                  $loan_tenure = $request->input('loan_tenure');
                                  $total_repayment =$this->Totalrepayment($loan_tenure,$l_amount);
                                  $datadiburst = [
                                    'user_id' => $request->input('user_id'),
                                    'loan_tenure' => $request->input('loan_tenure'),
                                    'repayment_amount' => $request->input('repayment_amount'),
                                    'mandate_id' => $request->input('mandate_id'),
                                    'total_repayment' =>$total_repayment ,
                                    'repayment_date' => $date,
                                    'loan_id' => $loan_id,
                                    'status' =>'paying' ];
                                     if (Loan_repayment::create($datadiburst)) {
                                      $datatransactlog = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $request->input('loan_amount'),
                                    'transaction_type' => 'disburstment',
                                    'user_id' => $request->input('user_id'),
                                   'mandate_id' => $request->input('mandate_id')];
                                     }
                                     if (Transaction_log::create($datatransactlog)) {

                                       $extension = $request->file->extension();
                                      $filename =  $loan_id.'.'.$extension;
                                      $path = $request->file->storeAs('public/loan_doc', $filename);
                                    
                                   

                                    $update_loan_record =Loan::where('loan_id', $loan_id)->update(
                                     [
                                     'loan_id' => $loan_id,
                                    'loan_tenure' => $request->input('loan_tenure'),
                                    'loan_amount' => $request->input('loan_amount'),
                                    'loan_repayment_amount' =>$request->input('repayment_amount'),
                                     'mandate_id' => $request->input('mandate_id'),
                                    'loan_doc' => $filename,
                                    'user_id' => $request->input('user_id'),
                                    'status' => 'approved' ]);

                                     }
                                     if ($update_loan_record) {

                                    $total_now =$available_balance - $request->input('loan_amount');

                                    DB::update('UPDATE wallet_transacts SET available_balance=?  WHERE transaction_type="loan"', [$total_now]);

                                    User::where('id',$request->input('user_id'))->update(['user_status'=> 'paying']);

                                     $userdata =Registration::where('user_id', $request->input('user_id'))->first();

                                         $details = [
                                            'loan_amount' =>$request->input('loan_amount'),
                                            'loan_tenure' =>$request->input('loan_tenure'),
                                            'repayment_amount' =>$request->input('repayment_amount'),
                                            'repayment_date' => $date,
                                            'user_name' =>$userdata->lastname
                                        ];
                                       
                                User::where('id',$request->input('user_id'))->update(['user_status'=> 'approved']);
                                       Mail::to($userdata->email)->send(new LoanMail($details));
                                      
                                  if (!Mail::failures()) {

                                 
                                 
                                        $getwallet =  DB::table('customer_wallets')
                                        ->where('user_id', '=', $request->input('user_id'))->first();
                                    if ($getwallet) {
                                     
                                      $balance = $getwallet->balance+$request->input('loan_amount');
                                       
                                   DB::update('UPDATE customer_wallets SET balance=?   WHERE user_id=? ', [$balance,$request->input('user_id')]);
                                  
                                    }else{

                                        DB::insert('INSERT INTO customer_wallets (balance,user_id,user_type,created_at,updated_at) VALUES(?,?,?,?,?)', [$request->input('loan_amount'), $request->input('user_id'),'guess', NOW(), NOW()]);

                                    }


                                     return  redirect('/loan-list')->with('success', 'loan successfully approved');

                                     }else{

                                      return  redirect('/user_preview/'.$user_id)->with('error', 'unable to send mail  with poor connection ');

                                     }

                                  }
                                 }
                            }
                       
                         }
                        
                       }
                     }elseif ($request->input('status') =='reject') {
                       $user_id = $request->input('user_id');
                      $validator = Validator::make($request->all(), [
                        'remark' => 'required',
                      
                      ]);

                      if ($validator->fails()) {
                       return  redirect('/user_preview/'.$user_id)->with('errors', $validator->errors());
                      
                       }else{

                         $time =time();
                                  $date = date('Y-m-d', $time);
                                  $loan_id = $request->input('loan_id');
                         
                                 $update_loan_record =Loan::where('loan_id', $loan_id)->update(
                                     [
                                      'loan_id' => $loan_id,
                                    'loan_tenure' => $request->input('loan_tenure'),
                                    'loan_amount' => $request->input('loan_amount'),
                                     'remark'  =>  $request->input('remark'),
                                    'user_id' => $request->input('user_id'),
                                    'status' => 'rejected' ]);
                                     if ($update_loan_record) {

                                User::where('id',$request->input('user_id'))->update(['user_status'=> 'rejected']);
                             
                              return  redirect('/loan-reject/')->with('success', 'loan successfully rejected');

                        }
                     }
                     
                         // loan review
                           }elseif ($request->input('status') =='review') {
                             
                          $user_id = $request->input('user_id');
                          $validator = Validator::make($request->all(), [
                            'loan_amount' => 'required',
                            'loan_tenure' => 'required',
                            'repayment_amount' => 'required',
                            'remark' => 'required'
                          ]);

                          if ($validator->fails()) {
                           return  redirect('/user_preview/'.$user_id)->with('errors', $validator->errors());
                          
                           }else{
                            $loan_id = $request->input('loan_id');

                                  $update_loan_record =Loan::where('loan_id', $loan_id)->update(
                                    [
                                      'loan_id' => $loan_id,
                                    'loan_tenure' => $request->input('loan_tenure'),
                                    'loan_amount' => $request->input('loan_amount'),
                                    'loan_repayment_amount' => $request->input('repayment_amount'),
                                    'remark' => $request->input('remark'),
                                    'user_id' => $user_id,
                                    'status' => 'review' ]);

                                    
                                     if ($update_loan_record) {

                              User::where('id',$request->input('user_id'))->update(['user_status'=> 'review']);

                              return  redirect('/loan-review/')->with('success', 'loan review  submitted , please wait for the customer reply');

                                     }

                           }

                  }

            }


                        public function loanlist()
                         {

                          $data = User::with('loans')->with('repayments')->with('registration')->where('user_type','guess')->orderby('id', 'desc')->get();

                         return  view('admin.loan-list')->with('data', $data);
                         }


                     

                     public function loan_application()
                     {
                       
                         $data = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->where('loans.status', '=', 'pending')->get();

                         return  view('admin.loan-application')->with('data', $data);
                     }
                     


                     public function loan_disburst()
                     {
                          $data = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->join('loan_repayments', 'loans.user_id', '=', 'loan_repayments.user_id')
                          ->where('loans.status', '=', 'approved')
                          ->select('*', 'loans.status as status')
                          ->get();

                         return  view('admin.loan-disburst')->with('data', $data);
                     } 
                     

                     public function loan_matured($value='')
                     {
                     $data = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->join('loan_repayments', 'loans.user_id', '=', 'loan_repayments.user_id')
                          ->where('loan_repayments.status', '=', 'paid')
                          ->select('*', 'loan_repayments.status as status')
                          ->get();

                         return  view('admin.loan-matured')->with('data', $data);
                     }
                      public function loan_reject()
                     {
                          $data = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->where('loans.status', '=', 'rejected')
                          ->select('*', 'loans.status as status')
                          ->get();

                         return  view('admin.loan-reject')->with('data', $data);
                     }



                     public function loan_review($value='')
                     {

                    $datas = DB::table('loans')
                          ->where('loans.status', '=', 'review')
                          ->get();
                    return  view('admin.loan-review')->with('datas',  $datas);
                     }


                      public function loanreview_preview($value)
                      {
                           $user_info = User::with('registration')->where('id', $value)->get();

                           $review_datas = DB::table('loans')
                          ->where('loans.status', '=', 'review')
                          ->where('loans.user_id', '=', $value)
                          ->first();


                         $check = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->where('loans.status', '=', 'pending')
                          ->where('loans.user_id', '=', $value)
                          ->first();

                       if ($check) {
                       $datas = $check;
                       }else{
                         
                         $datas = DB::table('users')
                         ->join('registrations', 'users.id', '=', 'registrations.user_id')
                          ->where('users.user_status', '=', 'review')
                          ->where('users.id', '=', $value)
                          ->first();

                       }
                        
                         $details = [
                          'user' => $user_info,
                          'review' =>  $review_datas,
                            'data' => $datas ];
                       return  view('admin.loan-review-preview')->with($details); 

                      }
                   


                        public function daily_loan_repayment()
                        {
                           $data= array();
                           $time =time();
                           $todayday = date('d', $time);;
                           $month =  date('m', $time);
                           $year = date('Y', $time);
                           $minusmonth = date('m', strtotime('-1 month'));
                           $minusdate = date("Y-m-d",strtotime('-1 day'));
                           $date = date("Y-m-d",$time);
                         $day_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE DAY(repayment_date)=:today AND  status='paying' AND created_at < :date_n order by id desc"), array(
                         'today' => $todayday,
                          'date_n' => $date));

                         foreach ($day_repay as $value) {
                          
                       
                         $day_transact_list = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at)  >= :minusdate AND  transaction_type ='repayment' AND mandate_id =:mandate_id order by  id desc "), array(
                          'minusdate' =>$minusdate,
                          'mandate_id' => $value->mandate_id,
                       ));
                        
                        $mandate_id[]= $value->mandate_id;
                         if ($day_transact_list) {
                       
                         }else{
                         
                           $data[] = $value;    
                         }
                    }

                    // print_r( $day_transact_list);

                
                      return   view('admin.daily-loan-repayment')->with('data', json_decode(json_encode($data), True));  

                        }





               public static function getCustomerLoan($loan_id, $user_id)
               {
                   $getloan = DB::table('loans')
                           ->join('users', 'loans.user_id', '=', 'users.id')
                            ->where('loans.loan_id', '=', $loan_id)
                             ->where('loans.user_id', '=', $user_id)->first();

                  return json_decode(json_encode($getloan), True);
               }


                    public function mark_repayment($loan_id='')
                    {

                       $getrepay = Loan_repayment::where('loan_id', $loan_id)->first();

                       $total_repayment =$getrepay->total_repayment;
                       $repayment_amount =$getrepay->repayment_amount;
                       $user_id = $getrepay->user_id;
                       $cal = $total_repayment-$repayment_amount; 
                       echo $mandate_id = $getrepay->mandate_id;
                         
                         if ($cal ==0 ) {
                          $update = Loan_repayment::where('loan_id', $loan_id)->update(
                            ['status' => 'paid','total_repayment'=> $cal ]);

                         }else{
                           $update = Loan_repayment::where('loan_id', $loan_id)->update(['total_repayment' => $cal ]);
                         }
                         
                                  $transact_id ='Ti'.rand(566767,432344); 
                            
                           $datatransactlog = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'repayment',
                                    'user_id' => $user_id,
                                     'mandate_id' => $mandate_id];
                                
                            if (Transaction_log::create($datatransactlog)) {
                             return redirect('/repay_day')->with('success', 'marked successfully');
                            }

                    }


                    public function mark_repayment_overdue_single($loan_id='')
                    {

                       $getrepay = Loan_repayment::where('loan_id', $loan_id)->first();

                       $total_repayment =$getrepay->total_repayment;
                       $repayment_amount =$getrepay->repayment_amount;
                       $user_id = $getrepay->user_id;
                       $cal = $total_repayment-$repayment_amount; 
                       echo $mandate_id = $getrepay->mandate_id;
                         
                         if ($cal ==0 ) {
                          $update = Loan_repayment::where('loan_id', $loan_id)->update(
                            ['status' => 'paid','total_repayment'=> $cal ]);

                         }else{
                           $update = Loan_repayment::where('loan_id', $loan_id)->update(['total_repayment' => $cal ]);
                         }
                         
                                  $transact_id ='Ti'.rand(566767,432344); 
                            
                           $datatransactlog = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'repayment',
                                    'user_id' => $user_id,
                                     'mandate_id' => $mandate_id];
                                
                            if (Transaction_log::create($datatransactlog)) {
                             return redirect('/overdue')->with('success', 'marked successfully');
                            }

                    }



                     public function overdue_repayment($value='')
                     {
                        
                        $data = array();
                         $minusday = date("Y-m-d", strtotime('-15 day'));
                         $date  = date('Y-m-d', strtotime('-15 day'));
                         $currentday = date('Y-m-d', strtotime('+1 day'));

                         $overdue_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE  status=:status  AND repayment_date >= :minusday AND   repayment_date <= :currentday  order by id desc"),
                          array(
                          'minusday'=> $minusday,
                          'currentday' => $currentday,
                         'status' => 'paying'));

                         foreach ($overdue_repay as $value) {
                          
                       
                         $overdue_transact = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at) >= :date  AND transaction_type ='repayment' AND  mandate_id =:mandate_id order by id desc  "),
                          array(
                              'date'=>$date,
                             'mandate_id' => $value->mandate_id,
                       ));

                         if ($overdue_transact) {
                          $data = null;  
                         }else{
                           $data[] = $value;    
                         }
                    }
                        
                        // print_r($overdue_repay);
                         return   view('admin.overdue')->with('data', json_decode(json_encode($data), True));  


                     }





                public function markall($value='')
                {

                         $data= array();
                           $time =time();
                           $todayday = date('d', $time);;
                           $month =  date('m', $time);
                           $year = date('Y', $time);
                           $minusmonth = date('m', strtotime('-1 month'));
                           $date = date("Y-m-d",strtotime('-1 month') );
                            $minusdate = date("Y-m-d",strtotime('-1 day'));
                           $daten = date("Y-m-d",$time);
                        $day_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE DAY(repayment_date)=:today AND  status='paying'  order by id desc"), array(
                         'today' => $todayday));

                         foreach ($day_repay as $value) {
                          
                       
                         $day_transact = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE DATE(created_at)  between 
                          $minusdate  and $daten  AND   transaction_type ='repayment' AND mandate_id =:mandate_id order by  id desc "), array(
                          
                         'mandate_id' => $value->mandate_id,
                       ));

                         if ($day_transact) {
                          $data = null;
                         }else{
                         

                           $data[] = $value;  

                           $user_loan_id[] = $value->loan_id;
             
                         }
                       }
                     

                         
                       for ($i = 0; $i < count($user_loan_id); $i++) {
                           
                        $getrepay = Loan_repayment::where('loan_id', $user_loan_id[$i])->first();

                       $total_repayment =$getrepay->total_repayment;
                       $repayment_amount =$getrepay->repayment_amount;
                       $user_id = $getrepay->user_id;
                       $cal = $total_repayment-$repayment_amount; 
                       $mandate_id = $getrepay->mandate_id;
                         
                         if ($cal == 0 ) {
                          $update = Loan_repayment::where('loan_id', $user_loan_id[$i])->update(
                            ['status' => 'paid','total_repayment'=> $cal ]);

                         }else{
                           $update = Loan_repayment::where('loan_id', $user_loan_id[$i])->update(['total_repayment' => $cal ]);
                         }
                         
                                  $transact_id ='Ti'.rand(566767,432344); 
                            
                              $datatransactlog[] = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'repayment',
                                    'user_id' => $user_id,
                                    'mandate_id' => $mandate_id,
                                     'created_at' => NOW(),
                                     'updated_at' => NOW()
                                      ];
                           }
                  
                          if (Transaction_log::insert($datatransactlog)) {
                             return redirect('/repay_day')->with('success', 'marked successfully');
                            }
                  
                }
                   
                        public function loan_wallets()
                {
                   $wallets = Wallet_transact::where('transaction_type', 'loan')->orderby('id', 'desc')->get();
                   
                $sum_wallet= DB::select( DB::raw("SELECT SUM(amount) as balance FROM wallet_transacts WHERE  transaction_type =:type  "), array('type' => 'loan'));
                   return view('admin.loan-wallet')->with(['wallets'=> $wallets, 'sum_wallets'=> $sum_wallet]);
                }

                public function markall_overdue($value='')
                {
                       $data = array();
                         $minusday = date("Y-m-d", strtotime('-15 day'));
                         $date  = date('Y-m-d', strtotime('-15 day'));
                         $currentday = date('Y-m-d', strtotime('+1 day'));

                         $overdue_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE  status=:status  AND repayment_date >= :minusday AND   repayment_date <= :currentday  order by id desc"),
                          array(
                          'minusday'=> $minusday,
                          'currentday' => $currentday,
                         'status' => 'paying'));

                         foreach ($overdue_repay as $value) {
                          
                       
                         $overdue_transact = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at) >= :date  AND transaction_type ='repayment' AND  mandate_id =:mandate_id order by id desc  "),
                          array(
                              'date'=>$date,
                             'mandate_id' => $value->mandate_id,
                       ));

                         if ($overdue_transact) {
                          $data = null;  
                         }else{
                         

                           $data[] = $value;  

                           $user_loan_id[] = $value->loan_id;
             
                         }
                       }
                     

                         if (!empty($user_loan_id)) {
                         
                       for ($i = 0; $i < count($user_loan_id); $i++) {
                           
                        $getrepay = Loan_repayment::where('loan_id', $user_loan_id[$i])->first();

                       $total_repayment =$getrepay->total_repayment;
                       $repayment_amount =$getrepay->repayment_amount;
                       $user_id = $getrepay->user_id;
                       $cal = $total_repayment-$repayment_amount; 
                       $mandate_id = $getrepay->mandate_id;
                         
                         if ($cal == 0 ) {
                          $update = Loan_repayment::where('loan_id', $user_loan_id[$i])->update(
                            ['status' => 'paid','total_repayment'=> 0 ]);

                         }else{
                           $update = Loan_repayment::where('loan_id', $user_loan_id[$i])->update(['total_repayment' => $cal ]);
                         }
                         
                                  $transact_id ='Ti'.rand(566767,432344); 
                            
                              $datatransactlog[] = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'repayment',
                                    'user_id' => $user_id,
                                    'mandate_id' => $mandate_id,
                                     'created_at' => NOW(),
                                     'updated_at' => NOW()
                                      ];
                           }
                         }
                        if (isset($datatransactlog)) {
                        
                          if (Transaction_log::insert($datatransactlog)) {
                             return redirect('/overdue')->with('success', 'marked successfully');
                            }

                          }

                }




                       public static function Interest($tenure, $principal)
                       {
                          $percentage = $tenure * 5;
                          $rawpercentage = $percentage/100;
                           $interest = $rawpercentage * $principal;

                           return $interest;
                       }

                        public static function Repayment($tenure, $principal)
                       {
                          $percentage = $tenure * 5;
                          $rawpercentage = $percentage/100;
                           $interest = $rawpercentage * $principal;
                           $interestprinc = $interest+$principal;
                            $repayments = $interestprinc/$tenure;

                           return $repayments;
                        } 


                            public static function Totalrepayment($tenure, $principal)
                       {
                          $percentage = $tenure * 5;
                          $rawpercentage = $percentage/100;
                           $interest = $rawpercentage * $principal;
                           $repayments = $interest+$principal;

                           return $repayments;
                        }
                       


                    // user loan






                      public function user_loans($value='')
                      {

                        $user_id = Auth::user()->id;
                        $getuser_loan= User::with('loans')->with('repayments')->where('id', $user_id)->get();
                        
                        $getcurrentloan[] = DB::table('loans')->where('user_id', '=', $user_id)->orderby('id', 'desc')->first();
                        $data = ['current_loan'=>$getcurrentloan, 'user_loans'=> $getuser_loan];

                        return view('user.user-loan')->with($data);
                      }
                      



                       public function user_loans_repayments()
                       {
                            
                         $user_id = Auth::user()->id;
                        $getuser_repayment= Transaction_log::where('user_id', $user_id)->where('transaction_type','repayment')->get();
                        
                        $getcurrentloan_repayment[] = DB::table('loan_repayments')->where('user_id', '=', $user_id)->orderby('id', 'desc')->first();

                      $data = ['current_loan_repay'=>$getcurrentloan_repayment, 'user_loan_repayments'=> $getuser_repayment];

                        return view('user.user-loan-repayment')->with($data);

                       }

                         public function user_loans_rejected()
                       {
                            
                        $user_id = Auth::user()->id;
                        $data = Loan::where('user_id',$user_id)->where('status','rejected')->get();
                        $data = [ 'data' => $data];

                        return view('user.user-loan-rejected')->with($data);

                       }
                       

                    public function user_loans_reviews()
                       {
                            
                         $user_id = Auth::user()->id;

                        $getuser_review= loan::where('user_id', $user_id)->where('status', 'review')->get();
                        
                        $getcurrentloan_review = DB::table('loans')->where('user_id', '=', $user_id)->where('status', '=', 'review')->orderby('id', 'desc')->first();

                      $data = ['current_loan_review'=>$getcurrentloan_review, 'user_loans_reviews'=> $getuser_review];

                        return view('user.user-loan-review')->with($data);

                       }

                       public static function loan_info($loan_id)
                       {
                        $getloan = Loan::where('loan_id', $loan_id)->get();

                        if ($getloan) {
                            return  $getloan;
                        }
                       }

                        public static function loan_info_list($loan_id)
                       {
                        $getloan = Loan::where('loan_id', $loan_id)->get();

                        if ($getloan) {
                            return  $getloan;
                        }
                       }

                       public static function loan_info_list_mandate($mandate_id)
                       {
                        $getloan = Loan::where('mandate_id', $mandate_id)->first();

                        if ($getloan) {
                            return  $getloan;
                        }
                       }


                      public function user_manual_repayment()
                                {

                                     $user_id = Auth::user()->id;
                                     $getuser_repayment=loan_repayment::where('user_id', $user_id)->where('status', 'paying')->orderby('id', 'desc')->first();
                                     return view('user.user-manual-repayments')->with('repay', $getuser_repayment);
                          }




                       public function user_transaction_log($value='')
                       {
                           $user_id = Auth::user()->id;
                           $transact = Transaction_log::where('user_id',$user_id)->orderby('id', 'desc')->get();

                          return view('user.user-transact-log')->with('transact', $transact);
                       }

                       public function user_loan_review_agreed($loan_id)
                       {

                         $update = Loan::where('loan_id', $loan_id)->update(['customer_reply' => 'agreed']);
                        return  redirect()->back()->with('success','You have agreed with Tomxcredit on your loan structure, please wait for response');
                       }

                        public function user_loan_review_disagreed($loan_id)
                       {
                        $update = Loan::where('loan_id', $loan_id)->update(['customer_reply' => 'disagreed']);
                        return redirect()->back()->with('success','You have disagreed with Tomxcredit on your loan structure, please wait for response');
                       }

                        public function user_loan_information()
                        {
                           $user_id = Auth::user()->id;
                          $show = Registration::where('user_id',$user_id)->first();
                           return view('user.user-information')->with('info', $show);
                        }

                        public function new_loan_application_form()
                         {
                          $user_id = Auth::user()->id;
                          $get_user_aprove =Loan::where('status', 'approved')->where('user_id', $user_id)->first();
                          if ($get_user_aprove) {
                            $data  = $get_user_aprove;
                         }elseif (empty($get_user_aprove)) {
                           $data =Loan::where('status', 'rejected')->where('user_id', $user_id);
                            }elseif (empty($data)) {
                            $data =Loan::where('status', 'review')->where('user_id', $user_id);
                            }else if (empty($data)) {
                             $data =Loan::where('status', 'new')->where('user_id', $user_id);
                         
                            }else{
                              $data = array();
                            }
                   
                          return view('user.new-loan-application')->with(['data' =>$data]);
                         }
                                       
                          public function loan_request(Request $request)
                           {
                                          
                                      $user_id = Auth::user()->id;
                                       $validator = Validator::make($request->all(), [
                                         'loan_amount' => 'required',
                                         'loan_tenure' => 'required'
                                       ]);
                                       if ($validator->fails()) {
                                        return redirect()->back()->with('errors', $validator->errors());
                                       }else{
                                       $getrepay = Loan_repayment::where('user_id', $user_id)->where('status', 'paying')->orderby('id', 'desc')->first();
                                       $checkapplic = Loan_repayment::where('user_id', $user_id)->where('status', 'new')->orderby('id', 'desc')->first();

                                       if ($getrepay) {
                                        
                                        return redirect()->back()->with('error', 'sorry, you must clear your  loan before you can request another.');
                                       }else if ($checkapplic) {
                                       	    return redirect()->back()->with('error', 'sorry, you already have new under process loan.');
                                       }else{

                                        $loan_id = 'Li'.rand(5667,4344);

                                        $amount = 

                                        $loan_repayment = $request->input('loan_amount')/$request->input('loan_tenure');
                                         
                                             $dataloan = [
                                      'loan_id' => $loan_id,
                                      'loan_tenure' => $request->input('loan_tenure'),
                                      'loan_amount' => $request->input('loan_amount'),
                                      'loan_repayment_amount' =>$loan_repayment,
                                      'user_id' =>  $user_id,
                                      'status' => 'pending' ];

                                User::where('id', $user_id)->update(['user_status'=> 'pending']);
                             

                                     if (Loan::create($dataloan)) {
                                          return redirect()->back()->with('success', 'loan request sent, please wait for reply, thank you.');
                                       }


                                      }
                                    }

                                  }


                                  // time ago

                                   public static function getTimeAgo($value)
                                {

                                   $user_id = Auth::user()->id;
                                  $site = new Site($user_id);

                                  return $site->timeAgo($value);
                                }


}
