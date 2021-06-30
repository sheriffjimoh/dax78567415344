
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
          <img src="{{asset('admin-assets/app-assets/images/portrait/small/avatar-s-26.png')}}" alt="users view avatar"
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
      @if($review->customer_reply)

     <div class="mb-20" style="padding-right: 10px;">
        <a href="#" class="btn btn-sm btn-primary" id="approve-btn">Approve Loan</a>
     </div>
     <div  style="padding-right: 10px;">
             <a href="#" class="btn btn-sm btn-warning"  id="disapprove-btn">Reject Loan</a>
     </div>

      <div>
             <a href="#" class="btn btn-sm btn-info"  id="review-btn">Review Loan</a>
     </div>
     @endif

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
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Primary Loan Details</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>
        


        <div class="col-12 ">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Customer ID:</td>
                <td class="users-view-username">{{$data->user_code}}</td>
              </tr>
              <tr>
                <td>Loan Amount:</td>
                <td class="users-view-username">{{'₦ '. $data->loan_amount}}</td>
              </tr>
              <tr>
                <td>Loan Tenure:</td>
              
              <td class="align-middle">
                                        @if($data->loan_tenure > 1)
                                        <div class="tenure">{{ $data->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($data->loan_tenure == 1)
                                        <div class="tenure">{{ $data->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>
                                  </tr>
              <tr>
                <td>Loan Interest:</td>
                <td class="users-view-name">{{'₦ '. ceil(LoanController::Interest($data->loan_tenure, $data->loan_amount))}}</td>
              </tr>
              <tr>
                <td>Monthly Repayment:</td>
                <td class="users-view-name">{{'₦ ' .ceil(LoanController::Repayment($data->loan_tenure, $data->loan_amount))}}</td>
              </tr>
            <!--   <tr>
                <td>E-mail:</td>
                <td class="users-view-email">{{ $data->email}}</td>
              </tr> -->
             


            </tbody>
          </table>
          
        </div>

      
         <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Review Loan Details</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12 ">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Loan ID:</td>
                <td class="users-view-username">{{$review->loan_id}}</td>
              </tr>
              <tr>
                <td>Loan Amount:</td>
                <td class="users-view-username">{{ '₦ '. $review->loan_amount}}</td>
              </tr>
              <tr>
                <td>Loan Tenure:</td>  <td class="align-middle">
                                        @if($review->loan_tenure > 1)
                                        <div class="tenure">{{ $review->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($review->loan_tenure == 1)
                                        <div class="tenure">{{ $review->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>
              </tr>
              <tr>
                <td>Loan Repayment Amount:</td>
                <td class="users-view-name">{{ '₦ '. $review->loan_repayment_amount}}</td>
              </tr>
              <tr>
                <td>Remark:</td>
                <td class="users-view-email">{{ $review->remark}}</td>
              </tr>
             
              <tr>
                <td>Customer Reply :</td>
                <td class="users-view-email">
                  @if($review->customer_reply)

                  <span class="text-success">{{$review->customer_reply}}</span>
                  @endif
                   @if( $review->customer_reply =='')

                  <span class="text-info">{{'pending'}}</span>
                  @endif
              </tr>
             


            </tbody>
          </table>
          
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
                                          <input type="hidden" name="user_id" value="{{$review->user_id}}">

                                          <input type="hidden" name="loan_id" value="{{$review->loan_id}}">
                                            <label>Loan Amount</label>
                                            <input type="text" class="form-control" name="loan_amount" placeholder="Loan amonut"
                                                value="{{$review->loan_amount}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Loan Tenure</label>
                                            <input type="text" class="form-control" name="loan_tenure" placeholder="Name"
                                                value="{{ $review->loan_tenure}}" required>
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <div class="controls">
                                            <label>Repayment Amount</label>
                                            <input type="text" class="form-control" placeholder="Name"
                                                value="{{$review->loan_repayment_amount}}" name="repayment_amount" required  readonly="">
                                        </div>
                                    </div>
                                             
                                        <div class="form-group">
                                          <p>kindly provide for this user, the remita form that determine the automation repayment. </p>
                                        <div class="controls">
                                            <label>Choose file </label>
                                            <input type="file" class="form-control" name="file" required style="opacity: 2;">
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Approve</button>
                                    <button type="reset" class="btn btn-light" id="cancel">Cancel</button>
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
                           <input type="hidden" name="user_id" value="{{$review->user_id}}">
                           <input type="hidden" name="loan_amount" value="{{$review->loan_amount}}">
                           <input type="hidden" name="loan_tenure" value="{{ $review->loan_tenure}}">

                            <input type="hidden" name="loan_id" value="{{$review->loan_id}}">
                            <div class="row"  >
                                <div class="col-12 col-sm-12">
                                        
                                        <div class="form-group">
                                         
                                        <div class="controls">
                    <textarea class="form-control" name="remark" placeholder="say something ...e.g " rows="8"  ></textarea>
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" onclick="return confirm('are you sure you want to reject this ?')" class="btn btn-warning glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reject</button>
                                    <button type="reset" class="btn btn-light" id="cancel">Cancel</button>
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
                                          <input type="hidden" name="user_id" value="{{$review->user_id}}">

                                          <input type="hidden" name="loan_id" value="{{$review->loan_id}}">
                                            <label>Loan Amount</label>
                                            <input type="text" class="form-control" name="loan_amount" placeholder="Loan amonut"
                                                value="{{$review->loan_amount}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Loan Tenure</label>
                                            <input type="text" class="form-control" name="loan_tenure" placeholder="Name"
                                                value="{{ $review->loan_tenure}}" required>
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <div class="controls">
                                            <label>Repayment Amount</label>
                                            <input type="text" class="form-control" placeholder="Name"
                                                value="{{$review->loan_repayment_amount}}" name="repayment_amount" required >
                                        </div>
                                    </div>
                                             
                              
                                        <div class="form-group">
                                         
                                        <div class="controls">
                    <textarea class="form-control" name="remark" placeholder="say something ...e.g " rows="5" ></textarea>
                                        </div>
                                    </div>
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Submit</button>
                                    <button type="reset" class="btn btn-light" id="cancel">Cancel</button>
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












?>