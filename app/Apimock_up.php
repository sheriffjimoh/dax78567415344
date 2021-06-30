<?php

namespace App;

// keys:::::
       // sk_test_8c320803fe203a4c22fbe68eacfc34f1ae26c14c
     
use Illuminate\Database\Eloquent\Model;

class Apimock_up extends Model
{
     public $createtransferres_url = "https://api.paystack.co/transferrecipient";
     public $initiatetransfer_url = "https://api.paystack.co/transfer";
     public $bvn_numberresolve_url = "https://api.paystack.co/bank/resolve_bvn/";
     public $account_numberresolve_url ="https://api.paystack.co/bank/resolve?";
     public $verify_new_payment_url ="https://api.paystack.co/transaction/verify/";
  public $remita_mandate_url = "https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/echannel/mandate/setup";
                 
     public $key  = '';


     public function Createtransferresipient($name,$account_number,$bank_code)
     {
     	
	  $fields = [
	    "type" => "nuban",
	    "name" => $name,
	    "description" => "Withdraw From my Tomxcredit wallet",
	    "account_number" => $account_number,
	    "bank_code" => $bank_code,
	    "currency" => "NGN"
	  ];
	  $fields_string = http_build_query($fields);
	  //open connection
	  $ch = curl_init();
	  
	  //set the url, number of POST vars, POST data
	  curl_setopt($ch,CURLOPT_URL, $this->createtransferres_url);
	  curl_setopt($ch,CURLOPT_POST, true);
	  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    "Authorization: Bearer ".$this->key,
	    "Cache-Control: no-cache",
	  ));
	  
	  //So that curl_exec returns the contents of the cURL; rather than echoing it
	  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
	  
	  //execute post
	  $result = curl_exec($ch);
	  $err = curl_error($ch);
              curl_close($ch);

               if ($result) {
                 $result = json_decode($result, true);
              } else {

               $result =  "cURL Error #:" . $err;
              }

          return  $result;



     }


	     public function initiatetransfer($amount, $recipient)
	     {
		     
		  $fields = [
		    "source" => "balance", 
		    "reason" => "Withdraw from my Tomxcredit wallet", 
		    "amount" => $amount, 
		    "recipient" => $recipient
		    ];
		  $fields_string = http_build_query($fields);
		  //open connection
		  $ch = curl_init();
		  
		  //set the url, number of POST vars, POST data
		  curl_setopt($ch,CURLOPT_URL, $this->initiatetransfer_url);
		  curl_setopt($ch,CURLOPT_POST, true);
		  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "Authorization: Bearer ".$this->key,
		    "Cache-Control: no-cache",
		  ));
		  
		  //So that curl_exec returns the contents of the cURL; rather than echoing it
		  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
		  
		  //execute post
		  $result = curl_exec($ch);
		   $err = curl_error($ch);
              curl_close($ch);

               if ($result) {
                 $result = json_decode($result, true);
              } else {

               $result =  "Error #:" . $err;
              }

          return  $result;


          	}



    
  

     public    function Resolveuserbvn($bvn_number)
        {

        	$url = $this->bvn_numberresolve_url.$bvn_number;
                      
              $curl = curl_init();
              
              curl_setopt_array($curl, array(
                CURLOPT_URL =>$url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Authorization: Bearer ".$this->key,
                  "Cache-Control: no-cache",
                ),
              ));
              
              $response = curl_exec($curl);
              $err = curl_error($curl);
              curl_close($curl);
               if ($response) {
                $result = json_decode($response, true);
              } else {

               $result =  "Error #:" . $err;
              }
       

           return $result;
       }


    



        function Resolveuseraccountnumber($account_number,$bank_code)
          {

          	$url = $this->account_numberresolve_url."account_number=".$account_number."&bank_code=".$bank_code;
             $result = array();
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             $headers = array(
                'Authorization: Bearer '.$this->key,
                'Content-Type: application/json',
              );
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

             $request = curl_exec ($ch);
             $err = curl_error($ch);
                    curl_close($ch);

             if ($request) {
               $result = json_decode($request, true);
             }else{
              $result = ['status' =>0, 'msg' =>$err];
             }
             //Use the $result array to get redirect URL
             return $result;
          }



           public function verify_new_payment($reference)
           {
            
           $url = $this->verify_new_payment_url.$reference; 
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL =>$url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->key,
                "Cache-Control: no-cache",
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            
           if ($response) {
               $result = json_decode($response, true);
             }else{
              $result =  "Error:" . $err;
             }
             //Use the $result array to get redirect URL
             return $result;


      }





    public function transferflutterwave($amount,$account_number,$bank_code,$reference)
     {
      
    $fields = [
      "account_bank" => $bank_code,
      "account_number" => $account_number,
      "amount" => $amount,
      "narration" => "Withdraw From My Tomxcredit Wallet",
      "reference": "akhlm-pstmnpyt-rfxx007_PMCKDU_1",
      "currency" => "NGN",
      "callback_url": "",
      "debit_currency": "NGN"];
    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $this->createtransferres_url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Authorization: Bearer ".$this->key,
      "Cache-Control: no-cache",
    ));
    
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    //execute post
    $result = curl_exec($ch);
    $err = curl_error($ch);
              curl_close($ch);

               if ($result) {
                 $result = json_decode($result, true);
              } else {

               $result =  "cURL Error #:" . $err;
              }

          return  $result;



     }
      


       public function  mandate()
       {
      
      $email = 'jimohsherifdeen6@gmail.com';
      $phone = '09034557339';
      $name = 'jimoh sherifdeen';
      $bankCode = "058";
      $accountNumber = "0253824896";
      $amount =4000;
      $maxNoOfDebits = 3;



       $fields = [
        "merchantId" => uniqid(), 
        "serviceTypeId" =>uniqid(), 
        "hash" => uniqid(), 
        "payerName" => $name,
        "payerEmail" => $email,
        "payerPhone" => $phone,
        "payerBankCode" => $bankCode,
        "payerAccount"=>$accountNumber,
        "requestId" => uniqid(),
        "amount" => $amount,
        "startDate" =>date('d-m-y'),
        "endDate" => date('22-12-2020'),
        "mandateType" => "DD",
        "maxNoOfDebits" => $maxNoOfDebits

        ];
      $fields_string = http_build_query($fields);
      //open connection
      $ch = curl_init();
      
      //set the url, number of POST vars, POST data
      curl_setopt($ch,CURLOPT_URL, $this->remita_mandate_url);
      curl_setopt($ch,CURLOPT_POST, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer ".$this->key,
        "Content-Type: application/json",
      ));
      
      //So that curl_exec returns the contents of the cURL; rather than echoing it
      curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
      
      //execute post
      $result = curl_exec($ch);
       $err = curl_error($ch);
              curl_close($ch);

               if ($result) {
                 $result = json_decode($result, true);
              } else {

               $result =  "Error #:" . $err;
              }

          return  $result;

       }







}
