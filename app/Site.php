<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Registration;
use App\User;
use DB;
use Twilio\Rest\Client;
class Site extends Model
{        

     function __construct($user_id = null)
     {
         $this->user_id = $user_id;
         return $this->user_id;
     }

 
         public function Isadmin()
         {

              $value = $this->user_id;
            $user =User::where('id', $value)->first();

            if ($user->user_type =='admin') {
               return true;
            }else{
                return false;
            }
         }


            public function Loggedin()
            {
               if ($this->user_id) {
                   
               return (bool) $this->user_id;
                }
            }


            public function Userid()
            {
                if ($this->user_id) {
                   
               return  $this->user_id;
                }
            }
               public function Username($id)
            {
              
              $getuser = User::where('id', $id)->first();

               if (empty($getuser->email) )  {
                   
                   return $getuser->email;
               }
            }


             public function Checkregistrationlevel()
             {
               $getuser = Registration::where('user_id', $this->Userid())->first();

               if (empty($getuser->bank_statement) )  {
                   
                   return true;
               }
             }

            public function User_registration()
             {
               $row[] = Registration::where('user_id', $this->Userid())->first();

               if ($row)  {
                 return $row;
               }
             }
              public function Checkfileextension($file_extension)
              {
              $allowed = array('png','jpg','jpeg');
              for ($i=0; $i < count($file_extension); $i++) {

                 if (!in_array($file_extension[$i], $allowed)) {
                 return false;
                 }
              }
              
              
              }
            

            public function user_bank_details()
            {
               $getuser   = Registration::where('user_id', $this->Userid())->first();

               $name = $getuser->firstname.' '.$getuser->lastname;
               if ($getuser) {
                  $user_bank = DB::table('tec_banks')
                   ->where('bank_name', '=',  $getuser->bank_name)->first();
                   if ($user_bank) {

                    $data = ['name' => $name, 'account_number' =>$getuser->bank_account_number, 'code' =>$user_bank->paystack_code ];

                    return  $data;
                   }

                  }

            }


             public function APP_ULR()
             {
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                $url = "https://";   
               else  
              $url = "http://";   
               // Append the host(domain name, ip) to the URL.   
              $url.= $_SERVER['HTTP_HOST'];   
        
             return $url;
             }

               public  function sendMessage($message, $recipients)
            {
                $account_sid = getenv("TWILIO_SID");
                $auth_token =  getenv("TWILIO_AUTH_TOKEN");
                $twilio_number = getenv("TWILIO_NUMBER");
                $client = new Client('AC4e80daa6cb236e5567c7cf4f0ff82d5c', '5dbd08af6c5aee60962c8569f58924c9');
                $result =  $client->messages->create($recipients, ['from' =>'+19387772578' , 'body' => $message]);
               if ($result) {
                return true;
               }
            }
          



          public function fund_user_wallet()
          {
                 $total = 0;
              $user_id =  $this->Userid();
        $getwallet = Customer_wallet::where('user_type','investor')->where('status','new')->where('user_id',$user_id)->get();
                      if (count($getwallet) > 0) {

                            foreach ($getwallet as $d) {
                             $total +=$d->balance;
                            }
                            $balance = $d->investor_balance+$total;
                $update = Customer_wallet::where('user_type','investor')->where('user_id',$user_id)->where('user_id',$user_id)->update(['investor_balance'=>$balance, 'status' =>'cleared']);
                 
                          }


                 return true;
          }



            public function GetreceivedDoc()
            {
           
              $i = Loan::where('user_id', $this->Userid())->where('status','approved')->orderby('id', 'desc')->get();
                
               if ($i) {
               return $i;
               }
            }



            public function get_investment_interest($amount,$tenure)
            {
              
              $result = array();
              $interest  = 0;
                      
                    if ($amount <= 1000000 && $tenure == 1) {
                         $interest =  (2.5 / 100) * $amount;
                         $result = [$interest,'2.5'];
                    }else if ($amount <= 1000000 && $tenure == 2) {
                          $interest =  (3 / 100) * $amount;
                           $result = [$interest,'3'];
                    }else if ($amount <= 1000000 && $tenure == 3){
                       $interest =  (4 / 100) * $amount;
                        $result = [$interest,'4'];
                    }else if ($amount <= 1000000 && $tenure == 6){
                       $interest =  (4.5 / 100) * $amount;
                       $result = [$interest,'4.5'];
                    }else if ($amount <= 1000000 && $tenure == 9){
                       $interest =  (4.75 / 100) * $amount;
                       $result = [$interest,'4.75'];
                    }else if ($amount <= 1000000 && $tenure == 12){
                       $interest =  (5 / 100) * $amount;
                       $result = [$interest,'5'];


                // 1m to 5m
                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 1){
                       $interest =  (0 / 100) * $amount;
                       $result = [$interest,'0'];

                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 2){
                       $interest =  (3 / 100) * $amount;
                       $result = [$interest,'3'];

                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 3){
                       $interest =  (3.5 / 100) * $amount;
                       $result = [$interest,'3.5'];

                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 6){
                       $interest =  (4 / 100) * $amount;
                       $result = [$interest,'4'];

                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 9){
                       $interest =  (4.5 / 100) * $amount;
                       $result = [$interest,'4.5'];

                    }else if ($amount >  1000000 && $amount <= 5000000 && $tenure == 12){
                       $interest =  (5 / 100) * $amount;
                       $result = [$interest,'5'];


                   
                   // 5m to 25m
                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 1){
                       $interest =  (0 / 100) * $amount;
                       $result = [$interest,'0'];

                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 2){
                       $interest =  (3.5 / 100) * $amount;
                       $result = [$interest,'0'];

                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 3){
                       $interest =  (4 / 100) * $amount;
                       $result = [$interest,'4'];

                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 6){
                       $interest =  (4.5 / 100) * $amount;
                       $result = [$interest,'4.5'];

                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 9){
                       $interest =  (4.75 / 100) * $amount;
                       $result = [$interest,'4.75'];

                    }else if ($amount >  5000000 && $amount <= 25000000 && $tenure == 12){
                       $interest =  (5/ 100) * $amount;
                       $result = [$interest,'5'];
                   
                      // 25m to 50m
                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 1){
                       $interest =  (0 / 100) * $amount;
                       $result = [$interest,'0'];

                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 2){
                       $interest =  (0 / 100) * $amount;
                       $result = [$interest,'0'];

                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 3){
                       $interest =  (4/ 100) * $amount;
                       $result = [$interest,'4'];

                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 6){
                       $interest =  (4.75 / 100) * $amount;
                       $result = [$interest,'4.75'];

                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 9){
                       $interest =  (5 / 100) * $amount;
                       $result = [$interest,'5'];

                    }else if ($amount >  25000000 && $amount <= 50000000 && $tenure == 12){
                       $interest =  (5.5 / 100) * $amount;
                       $result = [$interest,'5.5'];
                   }

                   return $result;

                  }




                   public function investment_repayment()
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
                      
                      
                        $check_transact= DB::select( DB::raw("SELECT * FROM transaction_logs  WHERE transaction_type='in-payment' AND user_id =:user_id AND   MONTH(created_at)=:month AND mandate_id=:mandate_id "), array(    
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


                           $total_remained[$i];
                                 
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
                                      'status'=>'new'
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
                                           'status'=>'new']; 
                                    
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




                 // get time ago


           public      function timeAgo($time_ago)
        {
             $timezone = 'Africa/lagos';
          date_default_timezone_set($timezone);

            $time_ago = strtotime($time_ago);
            $cur_time   = time();
            $time_elapsed   = $cur_time - $time_ago;
            $seconds    = $time_elapsed ;
            $minutes    = round($time_elapsed / 60 );
            $hours      = round($time_elapsed / 3600);
            $days       = round($time_elapsed / 86400 );
            $weeks      = round($time_elapsed / 604800);
            $months     = round($time_elapsed / 2600640 );
            $years      = round($time_elapsed / 31207680 );
            // Seconds
            if($seconds <= 60){
                return "just now";
            }
            //Minutes
            else if($minutes <=60){
                if($minutes==1){
                    return "one minute ago";
                }
                else{
                    return "$minutes minutes ago";
                }
            }
            //Hours
            else if($hours <=24){
                if($hours==1){
                    return "an hour ago";
                }else{
                    return "$hours hrs ago";
                }
            }
            //Days
            else if($days <= 7){
                if($days==1){
                    return "yesterday";
                }else{
                    return "$days days ago";
                }
            }
            //Weeks
            else if($weeks <= 4.3){
                if($weeks==1){
                    return "a week ago";
                }else{
                    return "$weeks weeks ago";
                }
            }
            //Months
            else if($months <=12){
                if($months==1){
                    return "a month ago";
                }else{
                    return "$months months ago";
                }
            }
            //Years
            else{
                if($years==1){
                    return "one year ago";
                }else{
                    return "$years years ago";
                }
            }
        } 
    

                             function convertNumberToWord($num = false)
{
       $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

}