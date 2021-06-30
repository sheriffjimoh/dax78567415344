@extends('layouts.app_header')

@section('content')

@php 
use App\Http\Controllers\LoanController; 
@endphp





     <section id="icon-tabs">    	 <!-- session message -->
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
    <div class="row">
        <div class="col-12">
            <div class="card">



      <?php 
       if (isset($error)) {
       
         $setwithdraw ='active';
         $balance =null;
       }
   else  {
         $setwithdraw =null;
         $balance ='active';
    
       }
  ?>
             
                 <div class="col-xl-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Loan Review, Loan Review Records</h4>
          <p>if your loan is under reviewing , this means that <a href=""><?php echo config('app.name');?></a>  is cross-checking some part of your loan details , you would find a message under this loan details that  describe the issue with your loan  and step to take forward

          <p class="text-warning">NOTE: if you must submit  <strong>agreed</strong>  or <strong>disagree</strong> and   failed to  in few days, we would take this as disagree and thus loan will be rejected.</p>
        </div>
        <div class="card-content">
          <div class="card-body">
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link {{$balance}}" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                  aria-controls="activeIcon1" aria-expanded="true"><i class="la la-money"></i> &nbsp;Current Loan Review</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{$setwithdraw}}" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                  aria-expanded="false"><i class="la la-folder-open"></i> &nbsp;Loan Review Records</a>
              </li>
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane {{$balance}}" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
                aria-expanded="true">





<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">

 
  <div class="group col-md-6  offset-md-3"> 

  @if ($current_loan_review)
     @php 
                          $interest= ceil(LoanController::Interest($current_loan_review->loan_tenure, $current_loan_review->loan_amount));  

                               $repayment = ceil(LoanController::Repayment($current_loan_review->loan_tenure, $current_loan_review->loan_amount));


                                 $total_repayment= ceil(LoanController::Totalrepayment($current_loan_review->loan_tenure, $current_loan_review->loan_amount));

                      @endphp

    <ul class="list-group">
       <li class="list-group-item"> 
        <h3 class="text-center">Current Loan Status : <span class="badge badge-success">{{$current_loan_review->status}}</span></h3></li>
          <li class="list-group-item">Loan id: <span class="pull-right" style="font-size: 15px;">{{$current_loan_review->loan_id}}</span> </li>
           <li class="list-group-item">Loan Amount: <span class="pull-right" style="font-size: 15px;">₦{{$current_loan_review->loan_amount}}</span> </li>
            <li class="list-group-item">Loan Tenure(month): <span class="pull-right" style="font-size: 15px;">{{$current_loan_review->loan_tenure}}</span> </li>

           <li class="list-group-item">Loan Repayment(monthly): <span class="pull-right" style="font-size: 15px;">₦{{ $repayment}}</span> </li>

           <li class="list-group-item">Interest: <span class="pull-right" style="font-size: 15px;">₦{{$interest}}</span> </li>
           <li class="list-group-item">Total Repayment: <span class="pull-right" style="font-size: 15px;">₦{{$total_repayment}}</span> </li>
           <br>
           <br>

            <li class="list-group-item text-center"> Message: <br> <span class="pull-left" style="font-size: 15px;">{{$current_loan_review->remark}}</span> </li>

         @if($current_loan_review->customer_reply =='')
            <li class="list-group-item text-center">

              <a href="/user_loan_review_agreed/{{$current_loan_review->loan_id}}" class="btn btn-success">Agree</a>
              <a href="/user_loan_review_disagreed/{{$current_loan_review->loan_id}}" class="btn btn-danger" onclick=" return confirm('this means that you are not agreed with Tomxcredit new term,  that this loan could be rejected/cancelled') ">Disagree</a>
              
            </li>
            @elseif($current_loan_review->customer_reply =='agreed')
             <li class="list-group-item text-center"> Replied: <br> <span class="pull-left" style="font-size: 15px;">I hereby agreed with <?php echo config('app.name');?> new loan structure.</span> </li>
                    
               
            @elseif ($current_loan_review->customer_reply =='disagreed')


             <li class="list-group-item text-center"> Replied: <br> <span class="pull-left" style="font-size: 15px;">I hereby disagreed with <?php echo config('app.name');?> new loan structure.</span> </li>

            @endif


    </ul>
  </div>
   @else

   <div>
     <ul class="list-group">
        <li class="list-group-item"> Your current loan reviewing will appears here..</li>
     </ul>
   </div>
  @endif
  
</section>
<!-- // grouped card stats section end -->







              </div>
              <div class="tab-pane {{$setwithdraw}}" id="linkIcon1" role="tabpanel" aria-labelledby="linkIcon1-tab1"
                aria-expanded="false">





                    <!-- Invoices List table -->
                  <div class="table-responsive">
                  <table id="example1" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Loan ID</th>
                        <th>Principal(₦)</th>
                        <th>Loan Tenure(Months)</th>
                        <th>Status</th>
                        <th>Loan Repayment Amount(₦)</th>
                        <th>Interest(₦)</th>
                        <th>Total repayment(₦)</th>
                        <th>Remark</th>
                        <th>Replied</th>
                  
                  
                    </tr>
                </thead>
                <tbody>
                  
                  @if(isset($user_loans_reviews))
                  @php $srno = 0; @endphp
                  @foreach($user_loans_reviews as $data)
                   @php $srno ++; 
             
              $interest = ceil(LoanController::Interest($data->loan_tenure, $data->loan_amount));  
                  
            
              $repayment = ceil(LoanController::Repayment($data->loan_tenure, $data->loan_amount));
      
            
               $total_repayment= ceil(LoanController::Totalrepayment($data->loan_tenure, $data->loan_amount));


                   @endphp
                  <tr>
                    <td>{{$srno}}</td>
                    <td>{{$data->loan_id}}</td>
                    <td>{{$data->loan_amount}}</td>
                    <td>{{$data->loan_tenure}}</td>
                    <td><span class="badge badge-success">{{$data->status}}</span>  </td>
                    <td>{{ $repayment}}</td>
                     <td>{{$interest}}</td>
                      <td>{{$total_repayment}}</td>
                      <td>{{ $data->remark}} <br></td>
                      <td>
                       @if($data->customer_reply =='agreed')
                        <span class="badge badge-success">{{$data->customer_reply}}</span></td>
                        @elseif($data->customer_reply =='disagreed')

                        <span class="badge badge-danger">{{$data->customer_reply}}</span></td>
                        @endif
                    
                  </tr>
                  @endforeach
                  @endif
                </tbody>
                <tfoot>
                    <tr>
                          <th>#</th>
                        <th>Loan ID</th>
                        <th>Principal</th>
                        <th>Loan Tenure</th>
                        <th>Status</th>
                        <th>Loan Repayment Amount</th>
                        <th>Repayment Date</th>
                    
                    </tr>
                </tfoot>
          </table>
          </div>
          <!--/ Invoices table -->








                
             
            </div>
          </div>
        </div>
      </div>
    </div>



               
            </div>
        </div>
    </div>
</section>
<!-- Form wizard with icon tabs section end -->


@endsection