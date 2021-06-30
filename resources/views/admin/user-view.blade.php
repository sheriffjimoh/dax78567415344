
@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\LoanController; 
@endphp
<!-- users view start -->
<section class="users-view new-print-view">
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
          <!-- session message -->
                     @if(Session::has('error'))
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='fa fa-warning'></i> Error!</h4>
                          <strong>{{ session('error') }}</strong>
                      </div>
                @endif
                       @if( isset($error))
                  <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='fa fa-warning'></i> Error!</h4>
                                <strong>{{ $error }}</strong>
                      </div>
                     @endif
                  @if($errors->any())
                     <div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='fa fa-warning'></i> Error!</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
             <!-- s -->
               @if(Session::has('success'))
             <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='fa fa-check'></i> Success!</h4>
                  {{ session('success') }}
              </div>
          @endif

        <?php 
            // $user_reg = $user->registration;
              foreach ($user as $single) {
              $data =  $single->registration;
 }

        ?>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ url('storage/user_profile_pic/'.(($single->profile_pic) ? $single->profile_pic : 'avatar-s-new.png'))}}" 


          alt="{{$data->firstname.''.$data->lastname}}" class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>

        <div class="media-body pt-25">
            <span
              class="text-muted font-medium-1"> @</span><span
              class="users-view-username text-muted font-medium-1 ">{{$data->firstname.''.$data->lastname}}</span></h4>
              <br>
          <span>Customer ID: {{ $data->user_code}}</span>
          <!-- <span class="users-view-id">305</span> -->
          @if($single->user_status =='new')
      <span class="badge badge-success">New Customer</span>
      @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2 print-no">
    
     <div class="mb-20" style="padding-right: 10px;">
        <a href="#" class="btn btn-sm btn-primary" id="approve-btn">Approved Loan</a>
     </div>
     <div  style="padding-right: 10px;">
             <a href="#" class="btn btn-sm btn-warning"  id="disapprove-btn">Rejected Loan</a>
     </div>

      <div>
             <a href="#" class="btn btn-sm btn-info"  id="review-btn">Reviewing Loan</a>
     </div>

    </div>
  </div>
  <!-- users view media object ends -->
 
  <!-- users view card details start -->
  <div class="card  print-card ">
    <div class="card-content" style="padding:10px;">
      <div class="row text-center">
         <div class="col-sm-4">
           <h4>Loan Approved: <i class="badge badge-primary">{{$count_approved}}</i>  <span class="la la-check  la-lg text-primary"></span></h4>
         </div>
         <div class="col-sm-4">
          <h4>Loan Rejected:<i class="badge badge-warning">{{$count_reject}}</i><span class="la la-close la-lg text-warning"></span></h4>
         </div>
         <div class="col-sm-4">
            <h4>Loan Reviewing: <i class="badge badge-info">{{$count_review}}</i> <span class="la la-book text-info"></span></h4>
         </div>
      </div>


      <div class="card-body" id="contents">
        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">PersonalDetails</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>



        <div class="col-12 ">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Firstname:</td>
                <td class="users-view-username">{{$data->firstname}}</td>
              </tr>
              <tr>
                <td>Lastname:</td>
                <td class="users-view-name">{{$data->lastname}}</td>
              </tr>
              <tr>
                <td>E-mail:</td>
                <td class="users-view-email">{{ $data->email}}</td>
              </tr>
              <tr>
                <td>Phone:</td>
                <td>{{$data->phone}}</td>
              </tr>
              <tr>
                <td>Marital-status:</td>
                <td>{{$data->marital_status}}</td>
              </tr>
              <tr>
                <td>Dependants:</td>
                <td>{{$data->dependants}}</td>
              </tr>


            </tbody>
          </table>
          </div>
          <div class="col-6 ">
                  <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Residential-state:</td>
                <td class="users-view-username">{{$data->resident_state}}</td>
              </tr>
              <tr>
                <td>L-G-A:</td>
                <td class="users-view-username">{{$data->lga}}</td>
              </tr>
              <tr>
                <td>House Address:</td>
                <td class="users-view-name">{{$data->house_address}}</td>
              </tr>
              
           
              <tr>
                <td style="font-weight: bolder;">Customer's Next of Kin</td>

              </tr>

                 <tr>
                <td>Fullname:</td>
                <td class="users-view-username">{{$data->fullname}}</td>
              </tr>
              <tr>
                <td>Phone:</td>
                <td class="users-view-username">{{$data->kin_phone}}</td>
              </tr>
              <tr>
                <td>Relationship:</td>
                <td class="users-view-name">{{$data->relationship}}</td>
              </tr>
              

            </tbody>
          </table>
          </div>
        </div>

        </div>

         

    
         <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
         <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
         <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">EmployerDetails</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12 ">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Employer's-name:</td>
                <td class="users-view-username">{{$data->employers_name}}</td>
              </tr>
              <tr>
                <td>Employer's-start-date:</td>
                <td class="users-view-name">{{$data->employers_startdate  }}</td>
              </tr>
              <tr>
                <td>Monthly-income:</td>
                <td class="users-view-email">{{ $data->monthly_income}}</td>
              </tr>
              <tr>
                <td>Employer's-loan-amount:</td>
                <td>{{$data->employers_loan_amount}}</td>
              </tr>
              <tr> <td>Employer's-loan-tenure:</td>
                <td>{{$data->employers_loan_tenure}}</td>
              </tr>
              <tr> <td>Employer's-loan-repayment:</td>
                <td>{{$data->employers_loan_repayment}}</td>
              </tr>


            </tbody>
          </table>
          </div>
          <div class="col-6">
                  <table class="table table-borderless">
            <tbody>
                <tr>
                <td>Employer's-email:</td>
                <td class="users-view-username">{{$data->employers_email}}</td>
              </tr>
             <tr>
                <td>Employer's-address:</td>
                <td class="users-view-name">{{$data->employers_address  }}</td>
              </tr>
           
            
           


            </tbody>
          </table>
          </div>
        </div>

        </div>

        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Loan Request </span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Loan-amount:</td>
                <td class="users-view-username">{{$data->loan_amount}}</td>
              </tr>
              <tr>
                <td>Loan-tenure:</td>
                <td class="users-view-name">{{$data->loan_tenure }}</td>
              </tr>
              <tr>
                <td>Monthly-income:</td>
                <td class="users-view-email">{{ $data->monthly_income}}</td>
              </tr>
             

            </tbody>
          </table>
          </div>
          
        </div>

        </div>

        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Bank Info </span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
               <tr>
                <td>Account-bvn:</td>
                <td class="users-view-email">{{ $data->bvn}}</td>
              </tr>
              <tr>
                <td>Bank-name:</td>
                <td class="users-view-username">{{$data->bank_name}}</td>
              </tr>
               <tr>
                <td>Bank-account-number:</td>
                <td class="users-view-name">{{$data->bank_account_number }}</td>
              </tr>
              <tr>
                <td>Bank-account-type:</td>
                <td class="users-view-name">{{$data->bank_account_type }}</td>
              </tr>

             

            </tbody>
          </table>
          </div>
                 <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
           
               <tr>
                <td style="font-weight: bolder;">Bank-statements</td>
              </tr>
               <tr>
                <td>Tickect-ID:</td>
                <td class="users-view-name">{{$data->ticket_id }}</td>
              </tr>
               <tr>
                <td>Password:</td>
                <td class="users-view-name">{{$data->password }}</td>
              </tr>
             
             

            </tbody>
          </table>
          </div>
          
        </div>

        </div>


            <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Documents</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <h2>Customer's ID card</h2>
                
              </tr>
               <tr>
              <img src="{{ url('storage/investment_doc/'.$data->id_card)}}" height="360px">
                <!-- <embed src="file_name.pdf" width="800px" height="2100px" /> -->
              </tr>
            

            </tbody>
          </table>
          </div>
            <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <h2>Work / Employer's ID card</h2>
                
              </tr>
               <tr>
              <img src="{{ url('storage/investment_doc/'.$data->staff_id_card)}}" height="360px">
                <!-- <embed src="file_name.pdf" width="800px" height="2100px" /> -->
              </tr>
            

            </tbody>
          </table>
          </div>
          
        </div>

        </div>

         
      </div>
<!-- end content -->


<!-- forms -->
      <div class="card-body" id="approve-form">

   <h2>
  <strong>{{$data->lastname}}'s Loan Approved Record</strong>
    </h2>
   <br>

  
          <div class="table-responsive">
                        <table class="table alt-pagination loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Loan ID</th>
                                     <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Borrower Name</th>
                                     <th class="border-top-0">Loan Repayment Amount</th>
                                      <th class="border-top-0">Loan Repayment Date</th>
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure (Months)</th>
                                    <th class="border-top-0">Interest (5%)</th>
                                    <th class="border-top-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                        <?php 

                            if (isset($loan_approved)) {
                                $srn =0;

                                foreach ($loan_approved as $value) {
                                 
                                  $tenure = $value->loan_tenure;
                                  $principal = $value->loan_amount;
                                 $interest = ceil(LoanController::Interest($tenure, $principal));  

                           ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$value->loan_id}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$value->user_code}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="borro-name">{{$value->firstname.''.$value->lastname}}
                                             </div>
                                    </td>
                                     <td class="align-middle">
                                        <div class="borro-name">
                                              {{$value->repayment_amount}}
                                             </div>
                                    </td>

                                 <td class="align-middle">
                                        <div class="borro-name">
                                              {{$value->repayment_date}}
                                             </div>
                                    </td>

                                    <td class="align-middle">
                                        <div class="loan-status badge badge-primary badge-pill badge-sm">{{$value->status}}</div>
                                    </td>
                                    
                                       <td class="align-middle">
                                        <div class="amount">{{'₦'. $value->loan_amount}}</div>
                                    </td>
                                    <td class="align-middle">
                                        @if($value->loan_tenure > 1)
                                        <div class="tenure">{{$value->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($value->loan_tenure == 1)
                                        <div class="tenure">{{$value->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>

                                      <td class="align-middle">
                                        <div class="interest">{{'₦'. $interest}}</div>
                                    </td>
                                    <td class="align-middle">
                                       
                                        <div class="interest">{{ date("Y-m-d h:i A",strtotime( $value->created_at)) }}</div>
                                    </td>
                                </tr>

                            <?php } }  ?>

                          </tbody>
                       </table>
          </div>
           </div>
    </div>


       <!-- loan disapprove start -->
           <div class="card-body" id="disapprove-form">
            
       <h2>
  <strong>{{$data->lastname}}'s Loan Rejected Record</strong>
        </h2>
      <div class="table-responsive">
                        <table  class="table alt-pagination loan-wrapper">
                            <thead>
                               <tr>
                                 <th class="border-top-0">Loan ID</th>
                                     <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Borrower Name</th>
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure (Months)</th>
                                    <th class="border-top-0">Interest (5%)</th>
                                    <th class="border-top-0">Date</th>                              

                                    </tr>
                            </thead>
                            <tbody>
                          
                                       <?php 

                            if (isset($loan_rejected)) {
                                $srn =0;

                                foreach ($loan_rejected as $user_rej) {
                              
                                     
                                   $tenure = $user_rej->loan_tenure;
                                  $principal = $user_rej->loan_amount;
                                 $interest = ceil(LoanController::Interest($tenure, $principal));  

                           ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$user_rej->loan_id}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$user_rej->user_code}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="borro-name">
                                              <a href="user-view/{{$user_rej->user_id}}">{{$user_rej->firstname.''.$user_rej->lastname}}</a>
                                             </div>
                                    </td>
                                    


                                    <td class="align-middle">
                                        <div class="loan-status badge badge-primary badge-pill badge-sm">{{$user_rej->status.'ed'}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="amount">{{'₦'.$user_rej->loan_amount}}</div>
                                    </td>
                                     <td class="align-middle">
                                        @if($user_rej->loan_tenure > 1)
                                        <div class="tenure">{{$user_rej->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($user_rej->loan_tenure == 1)
                                        <div class="tenure">{{$user_rej->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>
                                     <td class="align-middle">
                                        <div class="interest">{{'₦'. $interest}}</div>
                                    </td>
                                    <td class="align-middle">
                                       
                                        <div class="interest">{{ date("Y-m-d h:i A",strtotime( $user_rej->created_at)) }}</div>
                                    </td>
                                </tr>

                            <?php } }  ?>
                              
                          </tbody>
                       </table>
          </div>

 
           </div>

           <!-- forms -->




           <!-- review loan -->
      <div class="card-body" id="review-form">

    <h2>
   <strong>{{$data->lastname}}'s Loan Reviewing Record</strong>
      </h2>

     <div class="table-responsive">
                        <table id="example1" class="table alt-pagination loan-wrapper">
                            <thead>
                              <tr>
                                     <th class="border-top-0">Loan ID</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure </th>
                                    <th class="border-top-0">Interest (5%)</th>
                                    <th class="border-top-0">Monthly Repayment</th>

                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($loan_review)) {

                                foreach ($loan_review as $data) {
                             
                                  $tenure = $data->loan_tenure;
                                  $principal = $data->loan_amount;
                                 $interest = ceil(LoanController::Interest($tenure, $principal)); 

                                 $repayment = ceil(LoanController::Repayment($tenure, $principal));  
                           ?>

                                <tr>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$data->loan_id}}</div>
                                    </td>
                                   
                                    
                                    
                                       <td class="align-middle">
                                        <div class="amount">{{'₦'. $data->loan_amount}}</div>
                                    </td>
                                    <td class="align-middle">
                                        @if($data->loan_tenure > 1)
                                        <div class="tenure">{{$data->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($data->loan_tenure == 1)
                                        <div class="tenure">{{$data->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>

                                    <td class="align-middle">
                                        <div class="interest">{{'₦'. $interest}}</div>
                                    </td>

                                     <td class="align-middle">
                                        <div class="interest">{{'₦'. $repayment}}</div>
                                    </td>

                                    <td class="align-middle">
                                        <div class="loan-status badge badge-primary badge-pill badge-sm">{{$data->status.'ing'}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="action">
                                            <a href="/loanreview-preview/{{ $data->user_id}}" ><i class="la la-eye primary"></i></a>
                                            
                                        </div>
                                    </td>
                                </tr>


                               <?php } }  ?>
                          </tbody>
                       </table>
          </div>
            
           </div>
    </div>

  </div>
  <!-- users view card details ends -->

</section>
<!-- users view ends -->


@endsection