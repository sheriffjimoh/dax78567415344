<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet_transact;
use App\User;
use App\Registration;
use App\Loan_repayment;
use App\Loan;
use App\Customer_wallet;
use App\Investment_portfolio;
use App\Investment;
use App\Transaction_log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\UserCredencials;
use Session;
use Validator;
use App\Mail\LoanMail;
use App\Site;
use App\Mail\ContactMail;
use App\Apimock_up;
use Auth;
use PDF;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{                        

                      public function Authorized($value='')
                      {
                       if (Auth::user()) {
                         if (Auth::user()->user_type == 'admin') {
                           return redirect('/admin');
                         }else{
                          return redirect('/guess');
                         }  
                           
                       }else{
                         return redirect('/login')->with('status', 'login is required!');

                       }
                      }

                         public function guess($year= null)
                        {        
                
                           if (Auth::user()->user_type == 'guess') {

                            // initiate repayment     
                          $site = new Site(Auth::user()->id);
                          echo   $site->investment_repayment();


                          // fund user wallet

                          $site->fund_user_wallet();

                               
                            $user_id = Auth::user()->id;
                                  // count approved data
                            $count_approved =Loan::where('status','approved')->where('user_id',$user_id)->count();
                                 // count disapproved data
                             $count_reject = Loan::where('status','rejected')->where('user_id',$user_id)->count();
                                  // count reveiwing data
                            $count_review =Loan::where('status','review')->where('user_id',$user_id)->count();
                            $current_status =Loan::where('user_id', $user_id)->orderby('id','desc')->first();
                             // customer available balance
                          $mywallet =  DB::table('customer_wallets')
                               ->where('user_id', '=', $user_id)->first();
                            // loan repayment 

                            $loan_repayment =Loan_repayment::where('user_id', $user_id)->where('status','paying')->orderby('id','desc')->first();
                            $loan =Loan::where('loan_id',$loan_repayment->loan_id ?? '')->first();



                             // Todays loan repayment
                       $time = time();
                       $todayday = date('d', $time);;
                           $month =  date('m', $time);
                           $year = date('Y', $time);
                           $minusmonth = date('m', strtotime('-1 month'));
                           $minusdate = date("Y-m-d",strtotime('-1 day'));
                           $date = date("Y-m-d",$time);

                           $total_amount_t = 0;

                      $day_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE DAY(repayment_date)=:today AND  status='paying' AND DATE(created_at) < :date_r AND  user_id=:user_id order by id desc"), array(
                         'today' => $todayday,
                         'date_r' => $date,
                         'user_id' => $user_id));
                      
                      if ($day_repay) {
                        foreach ($day_repay as $value) {
                          
                       
                         $day_transact_list = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at)  >= :minusdate AND  transaction_type ='repayment' AND mandate_id =:mandate_id order by  id desc "), array(
                          'minusdate' =>$minusdate,
                          'mandate_id' => $value->mandate_id,
                       ));
                        
                        $mandate_id[]= $value->mandate_id;
                         if ($day_transact_list) {
                          // $round_all = array();
                           $total_amount_t  = 0;
                         }else{
                           $total_amount_t = $value->repayment_amount;
                           // $round_all[] = $value;    
                         }
                       }

                      }


                       // overdue repayment total
                      // overdue loan repayment 
                       
                         $minusday = date("Y-m-d", strtotime('-15 day'));
                         $date  = date('Y-m-d', strtotime('-15 day'));
                         $currentday = date('Y-m-d', strtotime('+1 day'));
                         $total_amount_o = 0;

                         $overdue_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE  status=:status  AND repayment_date >= :minusday AND   repayment_date <= :currentday AND user_id=:user_id  order by id desc"),
                          array(
                          'minusday'=> $minusday,
                          'currentday' => $currentday,
                         'status' => 'paying',
                         'user_id' => $user_id));
                         if ($overdue_repay) {

                         foreach ($overdue_repay as $value) {
                          
                       
                         $overdue_transact = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at) >= :date  AND transaction_type ='repayment' AND  mandate_id =:mandate_id AND user_id=:user_id order by id desc  "),
                          array(
                              'date'=>$date,
                              'mandate_id' =>$value->mandate_id,
                              'user_id' =>$user_id ));

                         if ($overdue_transact) {
                          $round_all_overdue = null; 
                           $total_amount_o = 0; 
                         }else{
                           $round_all_overdue[] = $value;   
                           $total_amount_o += $value->repayment_amount; 
                         }
                       }
                        }else{
                          $round_all_overdue = array();
                      }
                            // user_trasaction log

                          $transact = Transaction_log::where('user_id',$user_id)->orderby('id', 'desc')->get();



                          // user chart 
                           if ($year !=null) {
                             $year = $year;
                            }else{
                              $year = date('Y');
                            }

                              $disburstment =0;
                              $repayment = 0;
                              $withdraw = 0;
                              // $year = date('Y');
                              $m = date('m');
                            $user_id = Auth::user()->id;
                          $disburst = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  
                           YEAR(created_at) = :year  AND  transaction_type =:type AND user_id =:user_id "), array(
                         'type' => 'disburstment',
                          'year' => $year,
                          
                          'user_id' => $user_id));
                          foreach ($disburst as $d) {
                            $disburstment +=$d->amount;
                          }

                          $repay = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE    
                         YEAR(created_at) =:year  AND  transaction_type =:type AND user_id =:user_id "), array(
                         'type' => 'repayment',
                          'year' => $year,
                       
                          'user_id' => $user_id));
                           foreach ($repay as $d) {
                            $repayment +=$d->amount;
                          }
                           
                          $withdr = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE 
                         YEAR(created_at) =:year  AND  transaction_type =:type  AND user_id =:user_id "), array(
                         'type' => 'withdraw',
                          'year' => $year,
                    
                          'user_id' => $user_id
                        ));
                         foreach ($withdr  as $d) {
                            $withdraw  +=$d->amount;
                          }
                          $data = ['transact'=>$transact, 'loan_pay' =>$total_amount_t, 'loan_overdue'=>$total_amount_o,
                           'monthly_repayment'=> $loan_repayment, 'wallet_balance' =>$mywallet , 'loan_status' => $current_status, 'count_approved' =>$count_approved,'count_rejected'=>$count_reject, 'count_review'=>$count_review,'withdraw_chart' => $withdraw,'disburstment_chart' =>$disburstment,'repayment_chart' =>$repayment, 'year'=>$year];
                           
                                return view('user.home')->with($data);

                           }elseif (Auth::user()->user_type == 'investor') {

                     // initiate repayment     
                          $site = new Site(Auth::user()->id);
                           $site->investment_repayment();
                           

                          // fund user wallet

                          $site->fund_user_wallet();







                           $user_id =Auth::user()->id;
                              $month = date('m');
                              $yeare = date('Y');
                            

                            $investment_amount = 0;
                              // count porfolios
                            $count_portfolio = Investment_portfolio::where('user_id', $user_id)->where('status','open')->count();

                             $get_portfolio = Investment_portfolio::where('user_id', $user_id)->where('status','open')->get();

                             foreach ($get_portfolio as $portfolio) {
                                $investment_amount += $portfolio->amount;
                             }
                              
                               // count matured
                            $count_matured= Investment_portfolio::where('user_id', $user_id)->where('status','close')->count();
                             
                              // count rejected
                            $count_rejected = Investment::where('user_id', $user_id)->where('status','rejected')->count();
                              
                           // max rate 
                       $max_rate_month = DB::select( DB::raw("SELECT MAX(rate) as max_rate FROM investments WHERE 
                         YEAR(created_at)=:year  AND MONTH(created_at)=:month AND  status=:status  AND user_id=:user_id  "), array(
                         'status' => 'approved',
                          'year' => $yeare,
                          'month' => $month,
                         'user_id' => $user_id
                        ));
                        
                         foreach ($max_rate_month as $v_r) {
                          $max_rate =  $v_r->max_rate;
                         }

                          
                           $max_invested_month = DB::select( DB::raw("SELECT MAX(amount) as max_invested FROM investments WHERE 
                         YEAR(created_at)=:year  AND MONTH(created_at)=:month AND  status=:status  AND user_id=:user_id  "), array(
                         'status' => 'approved',
                          'year' => $yeare,
                          'month' => $month,
                         'user_id' => $user_id
                        ));
                        
                         foreach ($max_invested_month as $v_i) {
                          $max_invested =  $v_i->max_invested;
                         }
                          // $max_rate = $max_rate_month->max_rate;

                              // monthly investment
                              $total_amount =0;
                      $invest_month = DB::select( DB::raw("SELECT * FROM investments WHERE 
                         YEAR(created_at)=:year  AND MONTH(created_at)=:month AND  status=:status  AND user_id=:user_id "), array(
                         'status' => 'approved',
                          'year' => $yeare,
                          'month' => $month,
                         'user_id' => $user_id
                        ));

                            foreach ($invest_month as $in_d) {
                             $total_amount += $in_d->amount;
                            }

                            // monthly interest
                            $total_amount_int =0;

                        $inter_month = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at) =:month AND 
                         YEAR(created_at) =:year  AND  transaction_type =:type  AND user_id=:user_id "), array(
                         'type' => 'in-payment',
                          'year' => $yeare,
                          'month' => $month,
                          'user_id'=>$user_id));
                             foreach ($inter_month as $dv) {
                            $total_amount_int +=$dv->amount;
                          }

                             // customer available balance
                          $mywallet =  DB::table('customer_wallets')
                               ->where('user_id', '=', $user_id)->first();
                               if ($mywallet) {
                                $mywallet_balance = $mywallet->investor_balance;
                               }else{
                                $mywallet_balance =0;
                               }

                            if ($year !=null) {
                             $year = $year;
                            }else{
                              $year = date('Y');
                            }

                             $months = array();
                              $investment = array();
                              $interest = array();
                              $inv_tottal = 0;
                              $int_tottal = 0;
                      for( $m = 1; $m <= 12; $m++ ) {

                          $invest = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at)=:month AND 
                           YEAR(created_at) = :year  AND  transaction_type =:type  AND user_id=:user_id"), array(
                         'type' => 'investment',
                          'year' => $year,
                          'month' => $m,
                           'user_id'=>$user_id));
                          foreach ($invest as $d) {
                            $inv_tottal +=$d->amount;
                          }

                          array_push($investment,$inv_tottal);

                          $inter = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at) =:month AND 
                         YEAR(created_at) =:year  AND  transaction_type =:type  AND user_id=:user_id "), array(
                         'type' => 'in-payment',
                          'year' => $year,
                          'month' => $m,
                          'user_id'=>$user_id));
                             foreach ($inter as $dv) {
                            $int_tottal +=$dv->amount;
                          }


                          array_push($interest,$int_tottal);


                              $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                              $month =  date('F', mktime(0, 0, 0, $m, 1));
                           array_push($months, $month);
                       }

                            $data = [
                            'months' => json_encode($months),
                            'investment' => json_encode($investment),
                             'interest' => json_encode($interest),
                             'year' => $year,'count_portfolio' => $count_portfolio,
                             'count_matured' => $count_matured,
                             'count_rejected' => $count_rejected,
                             'my_balance' =>$mywallet_balance,
                             'monthly_investment' =>$total_amount,
                             'monthly_interest' =>$total_amount_int,
                             'max_rate' => $max_rate,
                             'max_invested' =>$max_invested,
                             'investment_amount'=>$investment_amount
                            ];

                             return view('investors.home')->with($data);
                           }else{
                            return redirect('/unknown');
                           }

                        }













                        public function admin( $year=null)
                        {

                          if (Auth::user()->user_type =='admin') {

                              
                            // initiate repayment     
                          $site = new Site(Auth::user()->id);
                          $site->investment_repayment();


                          // fund user wallet

                          $site->fund_user_wallet();

                            if ($year !=null) {
                             $year = $year;
                            }else{
                              $year = date('Y');
                            }
                              $months = array();
                              $disburstment = array();
                              $repayment = array();
                              $withdraw = array();
                              $mth = date('m');
                              $total_w = 0;
                              $total_r =0;
                              $total_d =0;


                              // Loan chart
                      for( $m = 1; $m <= 12; $m++ ) {

                          $disburst = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at)=:month AND 
                           YEAR(created_at) = :year  AND  transaction_type =:type "), array(
                         'type' => 'disburstment',
                          'year' => $year,
                          'month' => $m));
                           foreach ($disburst as $d) {
                             $total_d +=$d->amount;
                          }
                          array_push($disburstment, $total_d);

                          $repay = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at) =:month AND 
                         YEAR(created_at) =:year  AND  transaction_type =:type "), array(
                         'type' => 'repayment',
                          'year' => $year,
                          'month' => $m));
                           foreach ($repay as $d) {
                             $total_r +=$d->amount;
                          }
                          array_push($repayment,$total_r);

                          $withdr = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  MONTH(created_at) =:month AND 
                         YEAR(created_at) =:year  AND  transaction_type =:type "), array(
                         'type' => 'withdraw',
                          'year' => $year,
                          'month' => $m));
                        foreach ($withdr as $d) {
                             $total_w +=$d->amount;
                          }
                          array_push($withdraw, $total_w);


                              $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                              $month =  date('F', mktime(0, 0, 0, $m, 1));
                           array_push($months, $month);
                       }


                        
                             $investment = array();
                              $interest = array();
                              $inv_tottal = 0;
                              $int_tottal = 0;



                              // investment Chart
                      for( $m = 1; $m <= 12; $m++ ) {

                          $invest = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at)=:month AND 
                           YEAR(created_at) = :year  AND  transaction_type =:type  "), array(
                         'type' => 'investment',
                          'year' => $year,
                          'month' => $m));
                          foreach ($invest as $d) {
                            $inv_tottal +=$d->amount;
                          }

                          array_push($investment,$inv_tottal);

                          $inter = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE   MONTH(created_at) =:month AND 
                         YEAR(created_at) =:year  AND  transaction_type =:type  "), array(
                         'type' => 'in-payment',
                          'year' => $year,
                          'month' => $m));
                             foreach ($inter as $dv) {
                            $int_tottal +=$dv->amount;
                          }


                          array_push($interest,$int_tottal);


                           //    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                           //    $month =  date('F', mktime(0, 0, 0, $m, 1));
                           // array_push($months, $month);
                       }


                       // new application investment
                       $new_inv_application = Investment::where('status','pending')->count();
                       // new loan application
                       $new_loan_application = Loan::where('status','pending')->count();
                         // new customer loan application
                       $new_customer_loan_application = Loan::where('status','new')->count();
                       
                       // Todays loan repayment
                       $time = time();
                       $todayday = date('d', $time);;
                           $month =  date('m', $time);
                           $year = date('Y', $time);
                           $minusmonth = date('m', strtotime('-1 month'));
                           $minusdate = date("Y-m-d",strtotime('-1 day'));
                           $date = date("Y-m-d",$time);

                           $total_amount_t = 0;

                             $round_all_overdue = array();

                      $day_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE DAY(repayment_date)=:today AND  status='paying' AND created_at < :date_n order by id desc"), array(
                         'today' => $todayday,
                          'date_n' => $date));                      
                      if ($day_repay) {
                        foreach ($day_repay as $value) {
                          
                       
                         $day_transact_list = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at)  >= :minusdate AND  transaction_type ='repayment' AND mandate_id =:mandate_id order by  id desc "), array(
                          'minusdate' =>$minusdate,
                          'mandate_id' => $value->mandate_id,
                       ));
                        
                        $mandate_id[]= $value->mandate_id;
                         if ($day_transact_list) {
                          $round_all = array();
                          $total_amount_t =0;
                         }else{
                           $total_amount_t += $value->repayment_amount;
                           $round_all[] = $value;    
                         }
                       }

                      }else{
                           $round_all = array();
                           $total_amount_t = 0;
                      }
                       
                    // overdue loan repayment 
                       
                         $minusday = date("Y-m-d", strtotime('-15 day'));
                         $date  = date('Y-m-d', strtotime('-15 day'));
                         $currentday = date('Y-m-d');
                         $total_amount_o = 0;
                        
                         $overdue_repay = DB::select( DB::raw("SELECT * FROM loan_repayments  WHERE  status=:status  AND repayment_date >= :minusday AND   repayment_date <= :currentday  order by id desc"),
                          array(
                          'minusday'=> $minusday,
                          'currentday' => $currentday,
                         'status' => 'paying'));
                         if ($overdue_repay) {

                         foreach ($overdue_repay as $value) {
                          
                       
                         $overdue_transact = DB::select( DB::raw("SELECT * FROM transaction_logs WHERE  DATE(created_at) >= :date  AND transaction_type ='repayment' AND  mandate_id =:mandate_id order by id desc  "),
                          array(
                              'date'=>$date,
                             'mandate_id' => $value->mandate_id,
                       ));

                         if ($overdue_transact) {
                          $round_all_overdue = null; 
                          $total_amount_o = 0; 
                         }else{
                           $round_all_overdue[] = $value;   
                           $total_amount_o += $value->repayment_amount; 
                         }
                       }
                       }else{
                           $round_all_overdue = array();
                            $total_amount_o = 0; 
                      }
                       
                        
                       


                       // investment Wallet Balance
                       $inv_balance = DB::select( DB::raw("SELECT SUM(amount) as balance FROM wallet_transacts WHERE  transaction_type =:type  "), array('type' => 'investment'));

                       foreach ($inv_balance as $inv_balance) { }


                       // investment Wallet Balance
                       $loan_balance = DB::select( DB::raw("SELECT SUM(amount) as balance FROM wallet_transacts WHERE  transaction_type =:type  "), array('type' => 'loan'));

                            foreach ($loan_balance as $loan_balance) { }
                    //  // count loan  user

                      $count_borrower = User::with('registration')->where('user_type','guess')->count();

                    //   // count investors

                       $count_investor = User::with('registration')->where('user_type','investor')->count();

                   
                       
                            $data = [
                            'withdraw' => json_encode($withdraw),
                            'months' => json_encode($months),
                            'disburstment' => json_encode($disburstment),
                             'repayment' => json_encode($repayment),
                             'year'  => $year,
                             'investment' =>json_encode($investment) ,
                             'interest' =>json_encode($interest),
                             'new_inv_application' =>$new_inv_application,
                             'new_loan_application' => $new_loan_application,
                             'today_repay' => count($round_all),
                             // 'overdue_repay' => count($round_all_overdue),
                             'investment_wallet' => number_format($inv_balance->balance,2),
                              'loan_wallet' => number_format($loan_balance->balance,2),
                              'today_repay_amount' => number_format($total_amount_t,2),
                              'overdue_repay_amount' => number_format($total_amount_o,2),
                              'count_borrower' => $count_borrower,
                              'count_investor' => $count_investor,
                              'count_new_customer'=>$new_customer_loan_application

                            ];
                            
                            return view('admin.home')->with($data);

                            
                   
                          
                        
                          }
                        }
                      

                  // public function index(Request $req)
                  // {
                  	     
                  //     return response()->json(['msg' => 'this is message from ajax']);
                  // }







                public function verify_user($value)

                {
                  if (!empty($value)) {
                             $id = 2;
                           $site = new Site($id);

                         $url = $site->APP_ULR();
                     $getuser = User::where('user_code', $value)->first();
                      $username = Registration::where('user_code', $value)->first();

                   if (empty($getuser->email_verrified_at)) {

                      $verify_user = DB::table('users')
                      ->where('user_code', $value)
                      ->update(['email_verified_at'=>Now()]);


                    if ($verify_user) {

                         $data = [
                            'user_name' => $username->lastname,
                             'user_email' =>$getuser->email,
                             'password' => $getuser->user_code,
                             'url' => $url
                               ];

                      $sendmail  =  Mail::to($getuser->email)->send(new UserCredencials($data));
                       if (!Mail::failures()) {
                          $success = Session::flash('success', 'we have sent your credencial infomation to your email, kindly look for it and login , Thanks.');
                              return  redirect('/login')->with($success);
                               }     

                       }
                   }

                  }
                
                }






                public function new_customers($value='')
                {
                       $data = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->where('loans.status', '=', 'new')
                          ->select('*', 'loans.status as status')
                          ->get();

                  return  view('admin.new-customer')->with('users',   $data );
                }


                   public function user_preview($value)
                   {
                   $user_info = User::with('registration')->where('id', $value)->get();

                    $loan_data =  Loan::where('user_id', $value)->first();
                                 $data = [
                                  'loan' => $loan_data,
                                  'user' => $user_info];

                  return  view('admin.user-preview')->with($data);

                   }
                

              
                


                  public function addfund(Request  $req)
                   {
                     
                    $validator = Validator::make($req->all(), [
                        'amount' => 'required']);
                   

                   if ($validator->fails()) {
                     return back();
                   }else{

                   $insertdata = [
                      'amount' => $req->input('amount'),
                      'user_id' => $req->input('user_id'),
                       'transaction_type' => 'loan'
                    ];

                     $wallets = Wallet_transact::orderby('id', 'desc')->get();
                  if (count($wallets) > 0) {
                    
                    if (Wallet_transact::create($insertdata)) {
                     $total_available = 0;
                    $wallets = Wallet_transact::orderby('id', 'desc')->get();

                      foreach ($wallets as $wallet) {
                       $total_available +=$wallet->amount;

                         }

                       if (DB::update('UPDATE wallet_transacts SET available_balance=? where transaction_type="loan"', [$total_available])) {
                          $success = Session::flash('success', 'Fund added.');
                         return  redirect('/loan-wallet')->with($success);
                       }
                     }
                  



                       }else{
                         
                           
                   $insertdata = [
                      'amount' => $req->input('amount'),
                      'user_id' => $req->input('user_id'),
                      'available_balance' => $req->input('amount'),
                      'transaction_type' => 'investment'
                    ];
                     if (Wallet_transact::create($insertdata)) {
                       $success = Session::flash('success', 'Fund added.');
                     return  redirect('/wallet')->with($success);
                     }
                        
                       }
                        
                   }
                }







                         public function user_view($value)
                         {
                              
                              // count approved data
                             $count_approved =Loan::where('status','approved')->where('user_id',$value)->count();
                             // count disapproved data
                              $count_reject = Loan::where('status','reject')->where('user_id',$value)->count();
                              // count reveiwing data
                              $count_review =Loan::where('status','review')->where('user_id',$value)->count();
                              // user loan approve
                               $loan_approved = DB::table('loans')
                           ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                            ->join('loan_repayments', 'loans.user_id', '=', 'loan_repayments.user_id')
                            ->where('loans.status', '=', 'approved')
                             ->where('loans.user_id', '=', $value)
                            ->select('*', 'loans.status as status')
                            ->orderby('loans.id', 'desc')
                            ->get();
                             

                             // user loan reject

                            $loan_rejected = DB::table('loans')
                         ->join('registrations', 'loans.user_id', '=', 'registrations.user_id')
                          ->where('loans.status', '=', 'reject')
                          ->where('loans.user_id', '=', $value)
                          ->select('*', 'loans.status as status')
                          ->get();

                          // user loan reviewing

                             $loan_review = DB::table('loans')
                            ->where('loans.status', '=', 'review')
                            ->where('loans.user_id' , '=' , $value)
                            ->get();


                              $user_info = User::with('registration')->where('id', $value)->get();
                                 
                                   $data = [

                            'count_approved' =>  $count_approved,
                            'count_reject' =>  $count_reject,
                            'count_review' =>  $count_review,
                            'loan_approved' => $loan_approved,
                            'loan_rejected' => $loan_rejected,
                            'loan_review' => $loan_review,
                              'user' => $user_info ];

                             return  view('admin.user-view')->with($data);

                         }
                         

                         public function user_view_investment($user_id)
                         {
                          


                              // count porfolios
                            $count_portfolio = Investment_portfolio::where('user_id', $user_id)->where('status','open')->count();
                              
                               // count matured
                            $count_matured= Investment_portfolio::where('user_id', $user_id)->where('status','close')->count();
                             
                              // count rejected
                            $count_rejected = Investment::where('user_id', $user_id)->where('status','rejected')->count();
                              
                              $user_info = User::with('registration')->where('id', $user_id)->get();

                              // portfolio
                       $get_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','open')->where('investment_portfolios.user_id',$user_id)->orderby('investment_portfolios.id','desc')->get();

                       // matured


                 
                    $get_m_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','close')->where('investment_portfolios.user_id',$user_id)->orderby('investment_portfolios.id','desc')->get();

                    // rejected


                    $rejected = Investment::where('status','rejected')->where('user_id',$user_id)->get();
                                 
                                   $data = [

                            'count_portfolio' =>  $count_portfolio,
                            'count_rejected' =>  $count_rejected,
                            'count_matured' =>  $count_matured,
                            'portfolio' => $get_datas,
                            'matured' =>$get_m_datas,
                            'rejected' =>$rejected,
                              'user' => $user_info ];

                             return  view('admin.user-view-investment')->with($data);

                         }
                      


                       public static function AdminName($value)
                       {
                        $username = User::where('id', $value)->select('name')->first();
                          if (!empty($username)) {
                           
                        return $username->name;
                          }
                       }
                       

                       public function allcustomer()
                       {
                         
                         $data = User::with('registration')->where('user_type','guess')->orderby('id','desc')->get();

                             return  view('admin.allcustomer')->with('data', $data);

                       }
                       

                         public function investment_customers()
                       {
                         
                         $data = User::with('registration')->where('user_type','investor')->orderby('id','desc')->get();

                             return  view('admin.investment-customers')->with('data', $data);

                       }

                       

                   



                       public function transaction_logs()
                       {
                          $data = Transaction_log::orderby('id','desc')->orderby('id','desc')->get();

                             return  view('admin.transaction_log')->with('data', $data);
                       }
                      




                         public function continue_registration()
                         {
                            if (Auth::user()->user_type = 'guess') {
                                    
                              $site = new Site(Auth::user()->id);
                             if ($site->Checkregistrationlevel()) {

                                return view('user.document-uploads');

                               }else{

                                 $user_data = $site->User_registration();
                                 $receivefile = $site->GetreceivedDoc();
                                return view('user.document-uploads')->with(['update' => $user_data, 'receivefile' => $receivefile ]);

                               }
                          
                            } 

                         }


                         public function updatecustomerdocument(Request $request)
                         {

                            $site = new Site(Auth::user()->id);
                            $username =str_replace(' ', '', Auth::user()->name);

                            $validator = Validator::make($request->all(),[
                                  'personal_idcard' => 'required',
                                  'employer_idcard' => 'required',
                                  'bank_statement' => 'required'
                            ]);

                            if ($validator->fails()) {
                             return redirect()->back()->with('errors', $validator->errors());
                            }else{

                           if ($request->hasFile('employer_idcard') && $request->hasFile('personal_idcard')) {

                            $file_extension = array($request->personal_idcard->extension(),$request->employer_idcard->extension(),$request->bank_statement->extension());
                              // check for extension png,jpg,jpeg
                             if ($site->Checkfileextension($file_extension)) {
                             return redirect()->back()->with('error', 'sorry, only image/png, image/jpeg and image/jpg files are allowed');
                               }else{

                              // define new file name
                                      $emplo_extension = $request->employer_idcard->extension();
                                      $pers_extension = $request->personal_idcard->extension();
                                      $ban_extension = $request->bank_statement->extension();

                                     $personal_filename  =  $username.'_'.'personalidcard'.'.'.$pers_extension;            
                                     $emplo_filename  =  $username.'_'.'employeridcard'.'.'.$emplo_extension;
                                     $bank_filename =$username.'_'.'bank_statement'.'.'.$ban_extension; 

                                  $update = Registration::where('user_id', $site->Userid())->update([
                                    'id_card' =>  $personal_filename,
                                    'staff_id_card' => $emplo_filename,
                                    'bank_statement' => $bank_filename ]);
                                  if ($update) {
                                     $path = $request->personal_idcard->storeAs('public/customer_idcards', $personal_filename);
                                     $path = $request->employer_idcard->storeAs('public/customer_idcards',  $emplo_filename);  
                                     $path = $request->bank_statement->storeAs('public/bank_statements',  $bank_filename);
                                     return redirect()->back()->with('success', 'documents updated successfully');
                                  }
                                 

                               }

                              }
                               
                               

                            }
                         }



                      public function user_wallet()
                      { 



                        $user_id = Auth::user()->id;
                      
                        $getwallet[]= DB::table('customer_wallets')
                               ->where('user_id', '=', $user_id)->first();
                          if ($getwallet) {
                           
                                  return view('user.wallet')->with('wallet', $getwallet);
                          }
                     
                      }


                        public function withdraw(Request $request)
                        {
                           
                         $apis = new Apimock_up;
                          $site = new Site(Auth::user()->id);
                           $user_id = Auth::user()->id;
                           $data = $site->user_bank_details();

                         if (Auth::user()->user_type !='guess' && Auth::user()->user_type !='investor') {
                           return redirect('/unknown')->with('error', 'unauthorized user');
                         }else{
                         
                         $validator = validator::make($request->all(),['amount' => 'required|integer','password'=> 'required']);
                         
                         if ($validator->fails()) {
                           if (Auth::user()->user_type == 'investor') {

                             return redirect('/wallet')->with(['errors'=> $validator->errors(), 'withdraw' => 'withdraw' ]);
                         
                           }else{

                             return redirect('/mywallet')->with(['errors'=> $validator->errors(), 'withdraw' => 'withdraw' ]);
                           }
                         }else{
                             
                             $balance = $request->input('balance');
                             $amount = $request->input('amount');
                             $password = $request->input('password');

                             if ($amount > $balance) {
                            
                          
                             if (Auth::user()->user_type == 'investor') {

                              return redirect('/wallet')->with(['error'=> 'you balance seems not up to that, try some other amount less', 'withdraw' => 'withdraw' ]);
                           }else{

                            return redirect('/mywallet')->with(['error'=> 'you balance seems not up to that, try some other amount less', 'withdraw' => 'withdraw' ]);}
                       
                             }elseif (!User::where('user_code',$password)->first()) {
                            
                               
                             if (Auth::user()->user_type == 'investor') {

                              return redirect('wallet')->with(['error'=> 'invalid code supplied', 'withdraw' => 'withdraw' ]);
                       
                           }else{

                            return redirect('/mywallet')->with(['error'=> 'invalid code supplied', 'withdraw' => 'withdraw' ]);}
                            
                             }else{
                                $name = $data['name'];
                                $account_number = $data['account_number'];
                                $bank_code = $data['code'];
                                $create_recipitient = $apis->Createtransferresipient($name,$account_number,$bank_code);
                                 
                                 if ($create_recipitient['status']) {
                                    
                                   $recipient =$create_recipitient['data']['recipient_code'];
                                    $amount  = $amount;
                                   $initiatetransfer =  $apis->initiatetransfer($amount, $recipient);

                                   if ($initiatetransfer) {



                                     if (Auth::user()->user_type == 'investor') {

                                         $remain = $balance-$amount;
                                        $updatewallet= DB::update('UPDATE customer_wallets SET investor_balance=? WHERE user_id=?', [$remain, $user_id]);

                                 if ($updatewallet) {

                                  $transact_id ='Ti'.rand(566767,432344); 
                                      $datatransactlog = [
                                    'transaction_id' => $transact_id,
                                    'amount' =>$amount,
                                    'transaction_type' => 'withdraw',
                                    'user_id' => $user_id];

                                     if (Transaction_log::create($datatransactlog)) {
                                        
                                        return redirect('/wallet')->with(['success'=>$initiatetransfer['message'], 'withdraw' => 'withdraw' ]);
                       
                                         }    
                                     }
                                      
                                     }elseif (Auth::user()->user_type == 'guess') {

                                  $remain = $balance-$amount;
                                        $updatewallet= DB::update('UPDATE customer_wallets SET balance=? WHERE user_id=?', [$remain, $user_id]);

                                 if ($updatewallet) {

                                  $transact_id ='Ti'.rand(566767,432344); 
                                      $datatransactlog = [
                                    'transaction_id' => $transact_id,
                                    'amount' =>$amount,
                                    'transaction_type' => 'withdraw',
                                    'user_id' => $user_id];

                                     if (Transaction_log::create($datatransactlog)) {
                                        
                                        return redirect('/mywallet')->with(['success'=>$initiatetransfer['message'], 'withdraw' => 'withdraw' ]);
                       
                                         }    
                                     }
                                       
                                     }
                                     
                                 
                                 

                                   }else{

                                 return redirect('/mywallet')->with(['error'=> 'transfer could not initiate', 'withdraw' => 'withdraw' ]);
                                  }
                                 }else{

                                 return redirect('/mywallet')->with(['error'=> $create_recipitient['message'], 'withdraw' => 'withdraw' ]);
                       
                                 }

                             }
             
                         }
                            
                      

                        
                   
                         }

                      }




                        public function update_personal_info(Request $request)
                        {

                         $user_id = Auth::user()->id;

                         // print_r($request->all());
                          if ($request->input('title')) {
                          $updated = Registration::where('user_id', $user_id)
                          ->update([
                         'title' => $request->input('title'),
                         'firstname' => $request->input('firstname'),
                         'lastname' => $request->input('lastname'),
                         'email' => $request->input('email'),
                          'marital_status' => $request->input('marital'),
                          'dependants' => $request->input('dependants'),
                          'education' => $request->input('education'),
                          'phone' => $request->input('phone'),
                          'resident_state' => $request->input('resident_state'),
                          'lga' => $request->input('lga'),
                          'house_address' => $request->input('house_address'),

                          'fullname' => $request->input('fullname'),
                          'kin_phone' => $request->input('kin_phone'),
                          'relationship' => $request->input('relationship') ]);

                        }elseif ($request->input('employer_name')) {
                          $updated = Registration::where('user_id', $user_id)
                          ->update([
                         'employers_name' => $request->input('employer_name'),
                         'employers_startdate' => $request->input('employer_startdate'),
                         'monthly_income' => $request->input('income'),
                         'employers_loan_repayment' => $request->input('repayment'),
                          'employers_loan_amount' => $request->input('employer_loanamount'),
                          'employers_loan_tenure' => $request->input('employer_loantenure'),
                          'employers_email' => $request->input('officemail'),
                          'employers_address' => $request->input('employer_address') ]);
                          }elseif ($request->input('bank_account_number')) {

                          $validator = Validator::make($request->all(), [
                            'bank_code' => 'required',
                            'bank_account_number' => 'required|max:10|min:10',
                            'bank_account_type' => 'required'
                          ]);


                            if ($validator->fails()) {
                              
                              return redirect()->back()->with('errors', $validator->errors()); 
                           
                            }else{
                               
                                $apis = new Apimock_up;

                                 // $payKey = "sk_test_68ef32d6d8ea1831fcdec9ec5e315ecc22a58ad2";
                                $account_no =$request->input('bank_account_number');
                                 $code = $request->input('bank_code');

                                  if ($this->getBankcode($code)) {
                                    $bank_d = $this->getBankcode($code);
                                  }else {
                                    $bank_d = $this->getBankname($code);
                                  }

                              $result = $apis->Resolveuseraccountnumber($account_no,$bank_d->paystack_code);
                               print_r($result);
                              if($result['status'])
                             {   


                                  $updated = Registration::where('user_id', $user_id)
                                  ->update([
                                   'bank_name' => $bank_d->bank_name,
                                   'bank_account_number' => $account_no,
                                   'bank_account_type' => $request->input('bank_account_type') ]);
                             }else{

                            return redirect()->back()->with('error', 'unable to resolve account number, please correct the numbers or bank name');
                             }
                      
                          if ($updated) {
                         return redirect()->back()->with('success','updated successfully');
                          }else{  
                         return redirect()->back()->with('error','unable to update record');
                          }

                          }




                        }

                        }



                      public function user_profile()
                      {
                          
                          
                             $user_id = Auth::user()->id;
                            $show = User::where('id',$user_id)->first();
                             return view('user.user-profile')->with('info', $show);

                      }
                          public function update_user_profile(Request $request)
                      {
                            $user_id = Auth::user()->id;
                           $password = $request->input('password');
                           $confirmpass = $request->input('confirm_password');
                           $validator =  Validator::make($request->all(), [
                        'username' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'] ]);

                           if ($validator->fails()) {
                             
                             return redirect()->back()->with('errors',$validator->errors());
                           }else {
                              
                            $update = User::where('id',$user_id)->update([
                        'name' => $request->input('username'),
                        'email' =>  $request->input('email'),
                        'password' => Hash::make($request->input('password_comfirmation')) ]);

                            if ($update) {
                             
                         return redirect()->back()->with('success','updated successfully');
                            }
                           }
                          
                      }


                      public function updateprofile_pic(Request $request)
                      {     
                         $site = new Site;
                         $user_id = Auth::user()->id;
                         $username = Auth::user()->name;
                            if ($request->hasFile('profile_pic')) {
                              $validator =  Validator::make($request->all(), [
                              'profile_pic' => ['required'] ]);
                               if ($validator->fails()) {
                             
                             return redirect()->back()->with('errors',$validator->errors());
                              }else {


                            $file_extension = array($request->profile_pic->extension());
                              // check for extension png,jpg,jpeg
                             if ($site->Checkfileextension($file_extension)) {
                             return redirect()->back()->with('error', 'sorry, only image/png, image/jpeg and image/jpg files are allowed');
                               }else{

                              // define new file name
                                      $pers_extension = $request->profile_pic->extension();
                                     $profile_pic_filename  =  $username.'.'.$pers_extension;            
                                  $update = User::where('id', $user_id )->update([
                                    'profile_pic' => $profile_pic_filename]);
                                  if ($update) {
                                     $path = $request->profile_pic->storeAs('public/user_profile_pic',  $profile_pic_filename);
                                     return redirect()->back()->with('success', 'profile picture updated successfully');
                                  }       
                             }    

                            }
                          }
                        }
                          

                                  

                                   public function verify_payment($reference)
                                   {

                                      $user_id = Auth::user()->id;
                                      $apis = new Apimock_up;
                                      $result = $apis->verify_new_payment($reference);

                                      if ($result['data']['status']=='success') {
                                      
                                       $amount = substr($result['data']['amount'], 0 , -2);
                                        $getrepay = Loan_repayment::where('user_id', $user_id)->where('status', 'paying')->orderby('id', 'desc')->first();

                                         $total_repayment =$getrepay->total_repayment;
                                         $repayment_amount =$amount;
                                         $loan_id = $getrepay->loan_id;
                                         $mandate_id = $getrepay->mandate_id;
                                         $user_id = $getrepay->user_id;
                                         $cal = $total_repayment-$repayment_amount; 
                                           
                                           if ($cal == 0 ) {
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
                                               return redirect('/user_manual_repayments')->with('success', 'successfully paid');
                                              }
                                     
                                      }

                                      

                                   }

                                     

                                 public function mandate_setup($value='')
                                 {
                                    $apis = new Apimock_up;

                                    $mandete = $apis->mandate();
                                    print_r($mandate);     
                                }




                              public  static function fullname($user_id)
                              {
                               $record = Registration::where('user_id',$user_id)->first();
                               
                               if ($record) {
                                   return  $record->firstname.' '.$record->lastname;
                               }
                         
                              }
                             

                             public function  manage_account($value='')
                             {
                               
                               $data =DB::table('users')
                           ->join('registrations', 'users.id', '=', 'registrations.user_id')
                            ->where('users.user_type', '!=', 'admin')
                            ->select('*', 'users.id as id', 'users.password as password')
                             ->orderby('users.id', 'desc')
                            ->get();
                                 return view('admin.manage-account')->with('data',$data);
                             }

                          public function activate_customer($user_id)
                          {

                          $getuser = User::where('id', $user_id)->first();
                         if ($getuser) {
                          
                          if ($getuser->account_status == 'on') {
                           $status = 'off';
                           $message = 'account deactivated successfull';
                          }else{

                           $status = 'on';
                           $message = 'account activated successfull';
                          }
                         $update = User::where('id', $user_id)->update(['account_status' =>$status]);


                         if ($update) {
                          return redirect()->back()->with('success',$message);
                         }
                          }else{
                                 return   redirect()->back()->with('error', 'No account found');
                          }
                         }


                            public function activate_admin($user_id)
                          {

                          $getuser = User::where('id', $user_id)->first();
                         if ($getuser) {
                          
                          if ($getuser->account_status == 'on') {
                           $status = 'off';
                           $message = 'account deactivated successfull';
                          }else{

                           $status = 'on';
                           $message = 'account activated successfull';
                          }
                         $update = User::where('id', $user_id)->update(['account_status' =>$status]);


                         if ($update) {
                          return redirect()->back()->with('success',$message);
                         }
                          }else{
                                 return   redirect()->back()->with('error', 'No account found');
                          }
                         }
                        


                        public function create_admin($value='')
                        {

                        $data =  User::where('user_type', 'admin')->get();

                        return view('admin.create-admin')->with('data', $data);
                        }
                       

                       public function create_new_admin(Request  $request)
                       {

                        $validator = validator::make($request->all(),[
                           'username' => 'required',
                           'email' => 'required|email|unique:users',
                           'password'=>'required',
                           'password_confirmation'=>'required',
                           'permission'=>'required']);

                        if ($validator->fails()) {
                         return redirect()->back()->with('errors', $validator->errors());
                        }else if ($request->input('password_confirmation') != $request->input('password') ) {
                         return redirect()->back()->with('error', 'the password doesnot match ');
                        }else{


                          $data = [
                            'name' => $request->post('username'),
                            'email' => $request->post('email'),
                            'password' => Hash::make($request->post('password_confirmation')),
                            'user_type' => 'admin',
                            'user_permission' => $request->post('permission') ];
                          if (User::create($data)) {
                            return redirect()->back()->with('success', 'account created successfull');
                       
                          }else{
                           return redirect()->back()->with('error', 'something went wrong');
                       
                          }
                         // return $request->all();
                        }
                       }

  

                                    public function getBankname($bank_id)
                                {
                                    $row = DB::table('tec_banks')->where('paystack_code', $bank_id)->first();
                                    if($row)
                                    {
                                        return $row;
                                    }
                                    return false;
                                }

                                    public function getBankcode($bank_name)
                                {
                                    $row = DB::table('tec_banks')->where('bank_name', $bank_name)->first();
                                    if($row)
                                    {
                                        return $row;
                                    }
                                    return false;
                                }

                                

                                public function get_pdf($value)
                                {
                                
                          $site = new Site(Auth::user()->id);

                         $get_details = Investment::where('investment_id',$value)->first();
                         $amount = $get_details->amount;
                         $tenure = $get_details->tenure;
                         $rate = $get_details->rate;
                         $user_id = $get_details->user_id;
                         $total_interest = $get_details->interest;
                         $amount_maturity = $amount+$total_interest;
                         $monthly_repayment = $total_interest/$tenure; 
                         $start_date = date('Y-m-d');
                         $end_date = date('Y-m-d',strtotime('+'. $tenure.' month',time()));

                         $user_data = Registration::where('user_id', $user_id)->first();
                          $data = [
                            'user_name' => $user_data->firstname .' '.$user_data->lastname,
                             'email' =>$user_data->email,
                             'user_id' => $user_data->user_id,
                             'date' => $start_date,
                             'amount' => $amount,
                             'tenure' => $tenure,
                             'rate' =>$rate,
                             'maturity_date' =>$end_date,
                             'interest_amount' => $total_interest,
                             'amount_maturity' => $amount_maturity,
                             'amount_word' =>$site->convertNumberToWord($amount)
                               ];
                            

                                  $pdf = PDF::loadView('pdf', $data);

                           // download PDF file with download method
                             return $pdf->download('Tomxcredit_investment_certificate.pdf');
                                }


                             


                          public function contactForm(Request  $request)
                          {
                           
                           if ($request->all()) {
                            $name = $request->input('name');
                            $email = $request->input('email');
                            $msg_subject = $request->input('msg_subject');
                            // $phone_number = $request->input('phone_message');
                            $message = $request->input('message');

                            $template = "Name:".$name;
                            // $template .="<br> Phone:".$phone_number;
                            $template .="<br> Email:".$email;
                            $template .="<br><br>".$message;

                            $details = [
                            'name'=>$name,
                            'email' => $email,
                            'message' =>$message,
                             'subject' => $msg_subject];

                          Mail::to('jimohsherifdeen6@gmail.com')
                          ->send(new ContactMail($details));
                                      
                          if (!Mail::failures()) {
                         
                            return response()->json(['msg'=>'Thank you for contacting us, we have received your messsage, we would reply back to your email ','status' => 200] );
                          
                          }else{
                              return response()->json(['msg'=>'something went wrong','status' => 404] );
                          
                          }

                           }

                          }




































                       public function test($value='')
                       {
                     $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    $addup = 0;
              
                    $todayday = date('d', strtotime('-1 day'));
                    $date = date("Y-m-d");
                    $day_repay = DB::select( DB::raw("SELECT * FROM investment_portfolios  WHERE DAY(start_date)=:today AND DATE(created_at) < :date_t  AND  status='open'"), array(
                         'today' => $todayday,'date_t' =>$date));
                     

                     if ($day_repay) {

                      foreach ($day_repay as $val) {
                      
                        $check_transact= DB::select( DB::raw("SELECT * FROM transaction_logs  WHERE transaction_type='in-payment' AND user_id =:user_id AND   MONTH(created_at)=:month AND  mandate_id=:mandate_id "), array(
                         'month' => $month,
                         'user_id' => $val->user_id,
                         'mandate_id' => $val->investment_id ));

                        if ($check_transact) {
                    
                        }else{
                            
                             $oddn = $val->monthly_payment+1;
                             $evenn = $val->monthly_payment-1;
                        
                          if ($val->total_repayment == $val->monthly_payment || $val->total_repayment == $oddn ||  $val->total_repayment == $evenn) {
                           $repayment[]=$val->monthly_payment + $val->amount;

                           $total_remained[]=0;
                           $total_repayment[] = $val->total_repayment;
                           $status []= 'close';
                           $investment_id[] = $val->investment_id;
                           $user_id[] = $val->user_id;

                          }else{
                           $repayment[] = $val->monthly_payment;
                             $total_repayment[] = $val->total_repayment;
                           $total_remained[]=$val->total_repayment - $val->monthly_payment;
                           $status [] = 'open';                           
                           $investment_id[] = $val->investment_id;
                           $user_id[] = $val->user_id;

                          }

                        }

                     
                      } //end loop
                        

                        // print_r($check_transact);


                       // start process
                      // print_r( $repayment);

                          if (!empty($repayment)) {
                          
                         for ($i=0; $i < count($repayment); $i++) { 
                            $repayment_amount =  $repayment[$i];
                           $user_id[$i];
                            $investment_id[$i]; 
                            $status[$i]; 

                            $transact_id ='Ti'.rand(566767,432344); 
                            
                                

                          if ($status[$i] == 'close') {


                            echo $total_remained[$i];
                                 
                         Investment_portfolio::where('investment_id', $investment_id[$i])->update(
                            ['status' => 'close','total_repayment'=>$total_remained[$i],'updated_at' => NOW()]);

                                       $datatransactlog[] = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'in-payment',
                                    'user_id' => $user_id[$i],
                                    'mandate_id'=>$investment_id[$i],
                                     'created_at' => NOW(),
                                     'updated_at' => NOW()
                                      ];

                                $datawallet[] = [
                                     'user_id' => $user_id[$i],
                                     'user_type' => 'investor',
                                     'balance'  =>$repayment_amount,
                                      'created_at' => NOW(),
                                      'updated_at' => NOW(),
                                      'status' => 'new'
                                ];
                        

                          }else{



                            

                             $datatransactlog[] = [
                                    'transaction_id' => $transact_id,
                                    'amount' => $repayment_amount,
                                    'transaction_type' => 'in-payment',
                                    'user_id' => $user_id[$i],
                                    'mandate_id'=>$investment_id[$i],
                                     'created_at' => NOW(),
                                     'updated_at' => NOW()
                                      ];

                         Investment_portfolio::where('investment_id', $investment_id[$i])->update(
                            ['status' => 'open','total_repayment'=>$total_remained[$i] ]);


                           
                                    $datawallet[] = [
                                         'user_id' => $user_id[$i],
                                         'user_type' => 'investor',
                                         'balance'  =>$repayment_amount,
                                          'created_at' => NOW(),
                                          'updated_at' => NOW(),
                                           'status' => 'new']; 
                                    
                          }

                        }  ///endloop
                       if (isset($datatransactlog) && !empty($datatransactlog)) {
                         
                      
                        if (Transaction_log::insert($datatransactlog) ) {
                          if (Customer_wallet::insert($datawallet)) {
                             return true;
                              }
                             
                            }

                          } 

                        }
                   





                     }
                  }


                              
}
