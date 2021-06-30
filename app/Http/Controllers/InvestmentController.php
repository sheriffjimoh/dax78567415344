<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Site;
use App\Apimock_up;
use App\Registration;
use App\Investment;
use App\Investment_portfolio;
use App\Wallet_transact;
use App\Customer_wallet;
use App\Transaction_log;
use Auth;
use App\Mail\InvestmentMail;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
   
   
                  public function application_form()
                  {

                       $user_id = Auth::user()->id;
                      $get_investment = Investment::where('user_id', $user_id)->where('status','pending')->orderby('id','desc')->first();
                  	return view('investors.application-form')->with('data', $get_investment);
                  }


                  public function application_create(Request $request)
                  {

                        $user_id = Auth::user()->id;
                             $site = new Site($user_id);
                             $apis = new Apimock_up;


                         if ($request->hasFile('file')) {
                             $filetypeallowed = array('png','jpeg','jpg');
                           
                             if (!in_array($request->file->extension(), $filetypeallowed)) {
                            
                             return  redirect()->back()->with('error', 'only png, jpeg and jpg files are allowed');

                              }else{

                                $reference = 'INV'.rand(897878458,876554653);

                                  $extension = $request->file->extension();
                                  $filename = $reference.'.'.$extension;
                                   $path = $request->file->storeAs('public/investment_doc', $filename);

                                 $amount = str_replace("," , "" ,$request->input('amount'));
                                $tenure = $request->input('tenure');
                                
                             $get_interest_rate = $site->get_investment_interest($amount,$tenure);
                              $rate = $get_interest_rate[1];
                              $total_interest =$get_interest_rate[0]*$tenure;
                             $total = $total_interest+$amount;
                                 $data = [
                               'amount'=> $amount,
                               'tenure'=> $tenure,
                               'investment_id'=>$reference,
                               'total'=> $total,
                               'interest'=>$get_interest_rate[0],
                               'status'=>'pending',
                               'rate'=>$rate,
                               'user_id'=>$user_id,
                               'payment_method'=>'transfer',
                                'file'=>$filename
                             ];


                                       
                             if (Investment::create($data)) {

                              return redirect()->back()->with('success', 'investment created successful');
                             }else{
                                 return redirect()->back()->with('error', 'unable to create record for investment');
                           
                             }


                              }

                            }else{

                  	    if ($request->all()) {
                  	  	 
              			        $reference = $request->input('reference');
                            $tenure = $request->input('tenure');
                            $result = $apis->verify_new_payment($reference);
                            if ($result['data']['status']=='success') {

                             $amount = substr($result['data']['amount'], 0 , -2);

                             $get_interest_rate = $site->get_investment_interest($amount,$tenure);
                             $total_interest =$get_interest_rate[0]*$tenure;
                             $total = $total_interest+$amount;
                             $rate = $get_interest_rate[1];
                             $data = [
                               'amount'=> $amount,
                               'tenure'=> $tenure,
                               'investment_id'=>$reference,
                               'total'=> $total,
                               'interest'=>$get_interest_rate[0],
                               'status'=>'pending',
                               'rate'=>$rate,
                               'user_id'=>$user_id,
                               'payment_method'=>'card'
                             ];

                             if (Investment::create($data)) {
                             
                             return response()->json(['msg'=> 'investment created successful', 'status'=>200] );
                         
                             }else{

                            return response()->json(['msg'=>  'unable to create record for investment','status'=>404] );
                             }


                             
                            }else{

                              return response()->json(['msg'=>'unable to verify payment','status' => 404] );
                      
                            }

                           }else{
                            return response()->json(['msg'=>  'unable to create user','status' => 404] );
                         }
                                  
                  }

                }


                     public function investment_application()
                     {
                      
                        $get_all = Investment::where('status','pending')->orderby('id','desc')->get();

                        return view('admin.investment-application')->with('data', $get_all);
                     }




                     public function investment_application_mark($value)
                     {
                      if ($value) {
                         $admin_id = Auth::user()->id;
                          $transact_id ='Ti'.rand(566767,432344); 

                          $site = new Site(Auth::user()->id);


                      
                        $get_details = Investment::where('investment_id',$value)->first();
                         $amount = $get_details->amount;
                         $tenure = $get_details->tenure;
                         $rate = $get_details->rate;
                         $user_id = $get_details->user_id;
                         $total_interest = $get_details->interest*$tenure;
                         $amount_maturity = $amount+$total_interest;
                         // $monthly_repayment = $total_interest; 
                         $start_date = date('Y-m-d');
                         $end_date = date('Y-m-d',strtotime('+'. $tenure.' month',time()));

                         $user_data = Registration::where('user_id', $user_id)->first();

                         $data = [
                          'amount' => $amount,
                          'total_interest' =>$total_interest,
                          'monthly_payment'=>$get_details->interest,
                           'total_repayment' =>$total_interest,
                          'investment_id'=>$value,
                          'user_id' => $user_id,
                          'start_date'=> $start_date,
                          'end_date' => $end_date,
                          'status' => 'open'
                         ];
                         

                         $totalAv = 0;
                         $datatransactlog = [
                                      'transaction_id' => $transact_id,
                                      'amount' =>$amount,
                                      'transaction_type' => 'investment',
                                      'user_id' => $user_id,
                                       'mandate_id' => $value];
                            $get_wallet = Wallet_transact::where('transaction_type','investment')->first();

                            $wallet_data = [
                           'amount' => $amount,
                           'user_id' => $admin_id,
                           'available_balance' => $amount,
                           'transaction_type' => 'investment',
                           'investor_id' =>  $user_id
                         ];

                          if (Investment_portfolio::create($data)) {
                             
                            // update investment

                            DB::update('UPDATE investments SET status=? where investment_id=?', ['approved',$value]); 
                            Transaction_log::create($datatransactlog);

                            Wallet_transact::create($wallet_data);

                            if ($get_wallet) {

                             $total_available =$amount+$get_wallet->available_balance;
                            DB::update('UPDATE wallet_transacts SET available_balance=? where transaction_type="investment"', [$total_available]); 
                             $id = 2;
                           $site = new Site($id);
                           $url = $site->APP_ULR();

                         $data = [
                            'user_name' => $user_data->firstname .' '.$user_data->lastname,
                             'email' =>$user_data->email,
                             'user_id' => $user_data->user_id,
                             'date' => $start_date,
                             'amount' => $amount,
                             'tenure' => $tenure,
                             'investment_id'=>$value,
                             'rate' =>$rate,
                             'maturity_date' =>$end_date,
                             'interest_amount' => $total_interest,
                             'amount_maturity' => $amount_maturity,
                             'amount_word' =>$site->convertNumberToWord($amount),
                             'url' => $url
                               ];

                      $sendmail  =  Mail::to($user_data->email)->send(new InvestmentMail($data));
                       if (!Mail::failures()) {

                          return response()->json(['msg'=> 'investment approved successful', 'status'=>200]);

                               } else{
                                return response()->json(['msg'=> 'unable to send mail only.)', 'status'=>404]);
                         
                               }

                           }else{

                          return response()->json(['msg'=> 'investment approved successful', 'status'=>200]);
                           }
                         
                       }else{
                         return response()->json(['msg'=> 'something went wrong', 'status'=>404]);
                         
                      }
                     }
                   }


                   public function investment_application_reject($value)
                   {
                      
                    $update =  DB::update('UPDATE investments SET status=? where investment_id=?', ['rejected',$value]);

                    if ($update) {

                       return response()->json(['msg'=> 'investment rejected successful', 'status'=>200]);

                     } else{
                       return response()->json(['msg'=> 'something went wrong', 'status'=>404]);
                         
                     }
                            
                   } 

                 

                   public function investment_portfolio($value='')
                   {
                    $get_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','open')->orderby('investment_portfolios.id','desc')->get();

                    return  view('admin.investment-portfolios')->with('data', $get_datas);
                   }
                   


                   public function investment_rejected($value='')
                   {
                    
                    $get_datas = Investment::where('status','rejected')->get();

                    return view('admin.investment-rejected')->with('data', $get_datas);
                   }
                        
                  public function investment_record($value='')
                   {
                    
                    $get_datas = Investment::all();

                    return view('admin.investment-records')->with('data', $get_datas);
                   }
                         


                public function investment_matured($value='')
                   {
                    $get_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','close')->orderby('investment_portfolios.id','desc')->get();

                    return  view('admin.investment-matured')->with('data', $get_datas);
                   }
                   
                  public function investment_wallet($value='')
                  {
                  
                  $wallets = Wallet_transact::where('transaction_type', 'investment')->orderby('id', 'desc')->get();

                  return view('admin.investment-wallet')->with('wallets', $wallets);
                }
                 

          


















              // customers
                public function portfolio()
                  {

                   $user_id = Auth::user()->id;
                 
                    $get_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','open')->where('investment_portfolios.user_id',$user_id)->orderby('investment_portfolios.id','desc')->get();

                    return  view('investors.portfolio')->with('data', $get_datas);
                   }

                   public function rejected($value='')
                   {
                   
                   $user_id = Auth::user()->id;
                    $get_datas = Investment::where('status','rejected')->where('user_id',$user_id)->get();

                    return view('investors.rejected')->with('data', $get_datas);
                   }


                              
                   public function matured()
                   {
                    
                   $user_id = Auth::user()->id;
                 
                    $get_datas =Investment_portfolio::join('investments','investments.investment_id', '=', 'investment_portfolios.investment_id')->where('investment_portfolios.status','close')->where('investment_portfolios.user_id',$user_id)->orderby('investment_portfolios.id','desc')->get();

                    return  view('investors.matured')->with('data', $get_datas);
                   }
               


                 public function transaction($value='')
                 {
                  $user_id = Auth::user()->id;
                  $data = Transaction_log::where('user_id', $user_id)->orderby('id','desc')->get();
                  return  view('investors.transaction-log')->with('transact', $data);
                }
                 

                 public function wallet($value='')
                 {
                     $user_id = Auth::user()->id;
                       $total = 0;
           
                $total_balance = Customer_wallet::where('user_type','investor')->where('status','cleared')->where('user_id',$user_id)->first();
               if ($total_balance) {
                $total =  $total_balance->investor_balance;
               }else{
                $total = 0;
                 }
                          return view('investors.wallet')->with('wallet', $total);
               
                 }
                  

                  public function bank_information($value='')
                  {
                   
                           $user_id = Auth::user()->id;
                          $show = Registration::where('user_id',$user_id)->first();
                           return view('investors.bank-information')->with('info', $show);
                  }

                  public function investment_repayment()
                 {
                    $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    $addup = 0;
              
                    $todayday = date('d', strtotime('-1 day'));
                    $date = date("Y-m-d");
                    $day_repay = DB::select( DB::raw("SELECT * FROM investment_portfolios  WHERE DAY(start_date)=:today AND MONTH(start_date) =:month  AND  status='open'"), array(
                         'today' => $todayday,'month' => $month));
                     

                     if ($day_repay) {

                      foreach ($day_repay as $val) {
                      
                        $check_transact= DB::select( DB::raw("SELECT * FROM transaction_logs  WHERE transaction_type='in-payment' AND user_id =:user_id AND  DAY(created_at)=:today  OR  MONTH(created_at) =:month AND mandate_id=:mandate_id "), array(
                         'today' => $day,
                         'month' => $month,
                         'user_id' => $val->user_id,
                         'mandate_id' => $val->investment_id ));

                        if (!$check_transact) {
                    
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
                       


                       // start process
                      // print_r( $repayment);

                          if (!empty($repayment)) {
                          
                         for ($i=0; $i < count($repayment); $i++) { 
                            $repayment_amount =  $repayment[$i];
                           $user_id[$i];
                            $investment_id[$i]; 
                            $status[$i]; 

                            $transact_id ='Ti'.rand(566767,432344); 

                             $get_data = Customer_wallet::where('user_id',$user_id[$i])->get();

                             foreach ($get_data as $ke) {
                               $addup +=$ke->balance;
                             }
                              
                              $arrtotal[] = $addup;
                                

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
                                     'status' =>'new',
                                      'created_at' => NOW(),
                                      'updated_at' => NOW()
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
                                         'status' =>'new',
                                          'created_at' => NOW(),
                                          'updated_at' => NOW()]; 
                                    
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

                 } //end

        


}
