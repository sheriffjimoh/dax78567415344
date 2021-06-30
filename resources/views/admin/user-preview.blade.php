
@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\LoanController; 
@endphp

<style type="text/css">
  

  .approve-form{
    display: none;
  }

</style>
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
             
                                  $tenure = $data->loan_tenure;
                                  $principal = $data->loan_amount;
                                 $repayment =0;
                                  // ceil(LoanController::Repayment($tenure, $principal));  
        ?>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ url('storage/user_profile_pic/'.(($single->profile_pic) ? $single->profile_pic : 'avatar-s-new.png'))}}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>

   
        <div class="media-body pt-25">
            <span
              class="text-muted font-medium-1"> @</span><span
              class="users-view-username text-muted font-medium-1 ">{{$data->firstname.''.$data->lastname}}</span></h4>
              <br>
          <span>Customer ID: {{ $data->user_code}}</span>
          <!-- <span class="users-view-id">305</span> -->
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2 print-no">
    
     <div class="mb-20" style="padding-right: 10px;">
        <a href="#" class="btn btn-sm btn-primary" id="approve-btn">Approve Loan</a>
     </div>
     <div  style="padding-right: 10px;">
             <a href="#" class="btn btn-sm btn-warning"  id="disapprove-btn">Reject Loan</a>
     </div>

      <div>
             <a href="#" class="btn btn-sm btn-info"  id="review-btn">Review Loan</a>
     </div>

    </div>
  </div>
  <!-- users view media object ends -->
 
  <!-- users view card details start -->
  <div class="card  print-card ">
    <div class="card-content">

      <div class="card-body" id="contents">
        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Personal Details</span></h6>
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
                <td>₦ {{ number_format($data->employers_loan_amount,2) }}</td>
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
                <td class="users-view-username">₦ {{ number_format($data->loan_amount,2) }}</td>
              </tr>
              <tr>
                <td>Loan-tenure(Months):</td>
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
              <img src="{{ url('storage/customer_idcards/'.$data->id_card)}}" width="350" height="200px">
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
              <img src="{{ url('storage/customer_idcards/'.$data->staff_id_card)}}" width="350" height="200px">
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




  <h4>Loan Request Details</h4>

  <p>Below are the details of <strong>{{$data->lastname}}</strong>  loan request, you can go ahead and approve this, only , if you are okay  with the request info...</p>




        <!-- users edit account form start -->
                        <form  action="/loan_process" method="post"  enctype="multipart/form-data">
                            <div class="row"  >
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="controls">
                                          <input type="hidden" name="status" value="approve">
                                          <input type="hidden" name="user_id" value="{{$single->id}}">

                                          <input type="hidden" name="loan_id" value="{{$loan->loan_id}}">
                                            <label>Loan Amount</label>
                                            <input type="text" class="form-control" name="loan_amount" placeholder="Loan amonut"
                                                value="{{$data->loan_amount}}" id="loan_amount" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Loan Tenure</label>
                                            <input type="text" class="form-control" name="loan_tenure" placeholder="Loan Tenure"
                                                value="{{ $data->loan_tenure}}" id="loan_tenure" required>
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <div class="controls">
                                            <label>Repayment Amount</label>
                                            <input type="text" class="form-control" placeholder="Repayment amount"
                                                value="{{$repayment}}" name="repayment_amount" id="repayment" required >
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="controls">
                                            <label>Mandate ID</label>
                                            <input type="text" class="form-control" placeholder="Remita mandate ID"
                                              name="mandate_id" required >
                                        </div>
                                    </div>
                                             
                                        <div class="form-group">
                                          <p>provide the remita form for the automation repayment. </p>
                                        <div class="controls">
                                            <label>Choose file </label>
                                            <input type="file" class="form-control" name="file" required  style="opacity: 2">
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Approve</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
            
           </div>
    </div>


       <!-- loan disapprove start -->
           <div class="card-body" id="disapprove-form">
            

  <h4>Reject Loan Request </h4>

  <p>please provide a remark below to identify your reason for rejecting this loan, let the customer  Know!</p>




        <!-- users edit account form start -->
                        <form  action="/loan_process" method="post"  enctype="multipart/form-data">
                          <input type="hidden" name="status" value="reject">
                           <input type="hidden" name="user_id" value="{{$single->id}}">

                                          <input type="hidden" name="loan_id" value="{{$loan->loan_id}}">
                           <input type="hidden" name="loan_amount" value="{{$data->loan_amount}}">
                           <input type="hidden" name="loan_tenure" value="{{ $data->loan_tenure}}">
                            <div class="row"  >
                                <div class="col-12 col-sm-12">
                                        
                                        <div class="form-group">
                                         
                                        <div class="controls">
                    <textarea class="form-control" name="remark" placeholder="say something ...e.g " rows="8"  ></textarea>
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" onclick="return confirm('are you sure you want to reject this ?')" class="btn btn-warning glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reject</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                          </div>
                        </form>
           </div>

           <!-- forms -->




           <!-- review loan -->
      <div class="card-body" id="review-form">




  <h4>Loan Request Review</h4>


        <!-- users edit account form start -->
                        <form  action="/loan_process" method="post"  enctype="multipart/form-data">
                            <div class="row"  >
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="controls">
                                          <input type="hidden" name="status" value="review">
                                          
                                          <input type="hidden" name="loan_id" value="{{$loan->loan_id}}">
                                          <input type="hidden" name="user_id" value="{{$single->id}}">
                                            <label>Loan Amount</label>
                                            <input type="text" class="form-control" name="loan_amount" placeholder="Loan amonut"
                                                value="{{$data->loan_amount}}" id="loan_amount_r" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Loan Tenure</label>
                                            <input type="text" class="form-control" name="loan_tenure" placeholder="Name"
                                                value="{{ $data->loan_tenure}}" id="loan_tenure_r" required>
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <div class="controls">
                                            <label>Repayment Amount</label>
                                            <input type="text" class="form-control" placeholder="Name"
                                                value="{{$repayment}}" name="repayment_amount" id="repayment_r" required >
                                        </div>
                                    </div>
                                             
                              
                                        <div class="form-group">
                                         
                                        <div class="controls">
                    <textarea class="form-control" name="remark" placeholder="say something ...e.g " rows="5" ></textarea>
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Submit</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
            
           </div>
    </div>

  </div>
  <!-- users view card details ends -->

</section>
<!-- users view ends -->


@endsection