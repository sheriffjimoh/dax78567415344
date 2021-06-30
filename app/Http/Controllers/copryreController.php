<?php

namespace App\Http\Controllers;

use App\Registration;
use App\User;
use App\site;
use Auth;
use App\Apimock_up;
use Hash;
use App\Loan;
use App\Wallet_transact;
use App\Customerwallet;
use App\Transaction_log;
use Illuminate\Http\Request;
use Validator;
use Twilio\Rest\Client;
use App\Mail\SendMail;
use App\Mail\UserCredencials;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Input;

// use App\Services\ResolveBvnApis; 
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      return view('website.registration');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Apis
      $apis = new Apimock_up;
        $id = 1;
       $site= new Site($id);

        if ($request->input('bvn')){
         
          $validator = Validator::make($request->all(), [
            'bvn' => 'required|unique:registrations|max:11']);

         $checkbvn = Registration::where('bvn' , $request->input('bvn'))->first();
  

        if ($checkbvn) {
            $checkusern = User::where('user_code', $checkbvn->user_code)->first();
            }else{
              $checkusern=false;
            }
      
      if ($checkusern) {
         return response()->json(['msg'=> 'this bvn already exist, choose another one!','status' => 404] );
      }else{


         if ($validator) {
         $userbvnnumber = $request->input('bvn');
         // $result = $apis->Resolveuserbvn($userbvnnumber);
         $result= true;
        
          if ($result) {

            // send sms
           // $recipients = $result['mobile'];
            $recipients ='+2349034557339';
            $codegenerate = rand(456753, 677463);
            $message = "Your Tomxcredit Verification code is : ". $codegenerate;
             
            $sendmessage = true;
            // $site->sendMessage($message, $recipients);
            $numberdisplay = substr($recipients, 11, 10);
            if ($sendmessage) {
            
             return response()->json(['msg'=>'we have sent a six digit code to the phone number that is related to this bvn','number_display' => $numberdisplay, 'code' => $codegenerate,'user_bvn' => $userbvnnumber, 'status' => 200] );

            }else{
                  return response()->json(['msg'=>'could not send message',  'status' => 404] );
            }

         
          }else  {
           return response()->json(['msg'=> $result['message'],  'status' => 404] );
          }
        


         }else  {
           return response()->json(['msg'=>  $validator->fails(),'status' => 404] );
          }
        }

       }elseif ($request->input('inputcode')) {

         $Inputcode = $request->input('inputcode');
          $expcode = $request->input('code');
           $userbvn = $request->input('user_bvn');


          if ($Inputcode ==  $expcode ) {
           

           // insert user data

            $data = [
              'user_code' => $Inputcode,
               'bvn'      => $userbvn ];

              //   $datauser = [
              // 'user_code' => $Inputcode,
              //  'password'      => $Inputcode,
              //   'bvn'      => $userbvn ];
               
               $checkIFexist = Registration::where('bvn' , $userbvn)->first();
               if ($checkIFexist) {
                   return response()->json(['msg'=> 'we have got your bvn, please take another step further and provide your personal details', 'code' => $checkIFexist->id, 'status' => 200] );
               }else{

                 // $creatUser = User::create($datauser);
              
               $creatUser = Registration::create($data);
              
                if ($creatUser) {
                   $checkIFexist = Registration::where('bvn' , $userbvn)->first();
                 
                   return response()->json(['msg'=> 'we have got your bvn, please take another step further and provide your personal details', 'code' => $checkIFexist->id, 'status' => 200] );
                 }else{
                     return response()->json(['msg'=>  'unable to create user','status' => 404] );
                 }
                       }
         

            
          }else{
                return response()->json(['msg'=>  'invalid code supplied','status' => 404] );
          }
          
       }else{
           return response()->json(['msg'=>  'something went wrong','status' => 404] );
       }




   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //

       //Apis
      $apis = new Apimock_up;
    
        if ($request->input('title')) {
            $checkphone = Registration::where('phone', $request->input('phone'))->first();

              $checkemail = User::where('email', $request->input('email'))->where('user_type', 'guess')->first();
          
              if ($checkemail) {

               return response()->json(['msg'=>  'the email address  is already exist','status' => 404] );

             
            } else if ($checkphone) {

                 return response()->json(['msg'=>  'the phone number is already exist','status' => 404] );

            
              }else{

            $affected = DB::table('registrations')
              ->where('id', $registration->id)
              ->update([
             'title' => $request->input('title'),
             'firstname' => $request->input('firstname'),
             'lastname' => $request->input('lastname'),
             'email' => $request->input('email'),
              'marital_status' => $request->input('marital'),
              'dependants' => $request->input('dependant'),
              'education' => $request->input('education'),
              'info' => $request->input('info'),
              'phone' => $request->input('phone'),

              'referal_code' => $request->input('referer'),
              'resident_state' => $request->input('state'),

              'lga' => $request->input('local'),
              'house_address' => $request->input('address'),

              'fullname' => $request->input('fullname'),
              'kin_phone' => $request->input('kin_phone'),
              'relationship' => $request->input('relationship') ]);
                 if ($affected) {
              
               return response()->json(['msg'=>'we have got your personal details, please take another step further and provide your employers  details','code' =>$registration->id, 'status' => 200] );

             }else{

               return response()->json(['msg'=>'failed to update',  'status' => 404] );
               }

              }

            


            }else if ($request->input('employer_name')) {

         $checkemail = Registration::where('employers_email', $request->input('officemail'))->first();
            
            if ($checkemail) {
             return response()->json(['msg'=>'the employer email already exist',  'status' => 404] );
            }else{
           
              $affected = DB::table('registrations')
              ->where('id', $registration->id)
              ->update([
             'employers_name' => $request->input('employer_name'),
             'employers_startdate' => $request->input('employer_startdate'),
             'monthly_income' => $request->input('income'),
             'employers_loan_repayment' => $request->input('repayment'),
              'employers_loan_amount' => $request->input('loanamount'),
              'employers_loan_tenure' => $request->input('loantenure'),
              'employers_email' => $request->input('officemail'),
              'employers_address' => $request->input('employer_address') ]);

             if ($affected) {
              
               return response()->json(['msg'=>'we have got your employer details, please take another step further and provide your loan  details','code' =>$registration->id, 'status' => 200] );

             }else{
               return response()->json(['msg'=>'failed to update',  'status' => 404] );
               }
               
             }

            }elseif ($request->input('real_loanamount')) {

             $affected = DB::table('registrations')
              ->where('id', $registration->id)
              ->update([
             'loan_amount' => $request->input('real_loanamount'),
             'loan_tenure' => $request->input('real_loantenure'),
                 ]);
                
             if ($affected) {
              
               return response()->json(['msg'=>'we have got your Loan details, please take another step further and provide your bank  details','code' =>$registration->id, 'status' => 200] );

             }else{
               return response()->json(['msg'=>'failed to update',  'status' => 404] );
               }




            }elseif ($request->input('bank_account_number')) {

                            $id = 2;
                           $site = new Site($id);
                           $url = $site->APP_ULR();


                     $payKey = "sk_test_68ef32d6d8ea1831fcdec9ec5e315ecc22a58ad2";
                   $account_no =$request->input('bank_account_number');
                     $code = $request->input('bank_name');
                  $result = $apis->Resolveuseraccountnumber($account_no,$code);

                  if($result['status'])
                 {   
                      
                   $getUser = Registration::where('id' , $registration->id)->first();
                     
                     $checkusern = User::where('user_code', $getUser->user_code)->first();

                    


                       $details = [
                                'user_name' =>$getUser->lastname,
                                 'loan_data' =>'loan_data',
                                'url' =>$url.'/verify_user/'.$getUser->user_code
                            ];

                      Mail::to($getUser->email)->send(new SendMail($details));
                      if (!Mail::failures()) {  
                           $getUser = Registration::where('id' , $registration->id)->first();
                           $username =  $getUser->firstname .' '.$getUser->lastname;
                              
                      
                           

                       $creatuser =   DB::insert('INSERT INTO users (name, email,user_code,user_type,user_status, password, created_at, updated_at) VALUES(?,?,?, ?, ?, ?, ?,?)', [$username,$getUser->email,$getUser->user_code,'guess','new', Hash::make($getUser->user_code) , NOW(), NOW()]);
                         

                         if ($creatuser){
                        $user = User::where('user_code' , $getUser->user_code)->first();
                            $bank_d = $this->getBankname($code);
                       $affected = DB::table('registrations')
                        ->where('id', $registration->id)
                        ->update([
                          'user_id' => $user->id,
                       'bank_name' => $bank_d->bank_name,
                       'bank_account_number' => $account_no,
                        'bank_account_type' => $request->input('bank_account_type') ]);
                         
                        // create loan
                           $loan_id = 'Li'.rand(5667,4344);

                           $principal = $getUser->loan_amount;
                           $tenure = $getUser->loan_tenure;
                           $percentage = $tenure * 5;
                           $rawpercentage = $percentage/100;
                           $interest = $rawpercentage * $principal;
                           $repayments = $interest+$principal;

                              $dataloan = [
                                    'loan_id' => $loan_id,
                                    'loan_tenure' =>   $tenure,
                                    'loan_amount' => $principal,
                                    'loan_repayment_amount' => $repayments,
                                    'user_id' => $user->id,
                                    'status' => 'new' ];
                            $create_loan = Loan::create($dataloan);

                        if ($affected  && $create_loan) { 

 
                       return response()->json(['msg'=>'having sure  your email is correct, we  must have landed a Verification link in your inbox, check it out!','code' =>$registration->id, 'status' => 200] );
                               
                                
                          }else{
                            return response()->json(['msg'=>'unable to update data',  'status' => 404] );
                          }

                        }else{
                            return response()->json(['msg'=>'unable to create user',  'status' => 404] );
                        }


                        }else{
                            return response()->json(['msg'=>'unable to send mail',  'status' => 404] );
                        }

                          
                  }else{
                     return response()->json(['msg'=>$result['message'],  'status' => 404] );
                  }
                 }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
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



 public function create_investment(Request $request)
 {
     $checkuseremail = User::where('email', $request->input('email'))->first();
     $checkuserphone = Registration::where('phone', $request->input('phone'))->first();
     $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:registrations']);
     if (empty($request->input('firstname'))) {
       return response()->json(['msg'=>'please provide firstname',  'status' => 404]);
     }elseif (empty($request->input('lastname'))) {
      return response()->json(['msg'=>'please provide lastname',  'status' => 404]);
     }elseif (empty($request->input('phone'))) {
     return response()->json(['msg'=>'please provide phone',  'status' => 404]);
     }elseif (empty($request->input('occupation'))) {
      return response()->json(['msg'=>'please provide occupation',  'status' => 404]);
     }elseif (empty($request->input('fullname'))) {
     return response()->json(['msg'=>'please provide fullname',  'status' => 404]);
     }elseif (empty($request->input('kinemail'))) {
      return response()->json(['msg'=>'please provide next of kin email',  'status' => 404]);
     }elseif (empty($request->input('kinphone'))) {
     return response()->json(['msg'=>'please provide next of kin phone',  'status' => 404]);
     }else if (empty($request->input('email'))) {
       return response()->json(['msg'=>'please provide email address',  'status' => 404]);
    }else if (empty($request->input('monthly_income'))) {
       return response()->json(['msg'=>'please provide your average monthly income ',  'status' => 404]);
    
    
   }else if ($checkuseremail){
       return response()->json(['msg'=>'this email already exist',  'status' => 404]);
    }else if ($checkuserphone) {
       return response()->json(['msg'=>'this phone number already exist',  'status' => 404]);
     }else{

        $user_code = rand(234943,787646);
        $username = $request->input('firstname').''.$request->input('lastname');

        $data = [
           
          'user_code' =>$user_code,
          'name' =>$username,
           'email' => $request->input('email'),
           'user_type' => 'investor',
           'password'=> hash::make($user_code)
        ];
      
     $createAccount = User::create($data);

     if ($createAccount) {
    
     $get_user = User::where('user_code', $user_code)->first();
     $user_id = $get_user->id;

     $re_data = [
     'firstname'=>$request->input('firstname'),
     'lastname'=>$request->input('lastname'),
     'email'=>$request->input('email'),
     'phone' =>$request->input('phone'),
     'monthly_income' =>$request->input('monthly_income'),
     'fullname' =>$request->input('fullname'),
     'kin_phone' =>$request->input('kinphone'),
     'kin_email' =>$request->input('kinemail'),
     'user_id' => $user_id, 
     'user_code' =>$user_code];
     $register_user = Registration::create($re_data);
    
       $affected = DB::table('registrations')->where('user_code', $user_code)->update(['user_id' =>$user_id]);
     }


                        $id = 2;
                           $site = new Site($id);
                           $url = $site->APP_ULR();
           

     if ($register_user) {
          $details = [
            'user_name' =>$get_user->lastname,
            'url' =>$url.'/verify_user/'.$get_user->user_code
           ];
        Mail::to($get_user->email)->send(new SendMail($details));
    if (!Mail::failures()) {

       return response()->json(['msg'=>'Account Created!','data'=>$request->input('email'), 'status' => 200]);
     }else{

    return response()->json(['msg'=>'something went wrong',  'status' => 404]);
  
     }
 
     }else{

    return response()->json(['msg'=>'something went wrong',  'status' => 404]);
  
     }
  
 }


}

}
