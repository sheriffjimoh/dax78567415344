@extends('layouts.app_header')

@section('content')

@php 
use App\Http\Controllers\MainController; 
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


        @if (isset($current_loan_repay))

      <?php foreach ($current_loan_repay as $current_loan_repay) {
       }

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
          <h4 class="card-title">Loan Repayment, Loan Repayment records</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link {{$balance}}" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                  aria-controls="activeIcon1" aria-expanded="true"><i class="la la-money"></i> &nbsp;Current Loan (Repaying)</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{$setwithdraw}}" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                  aria-expanded="false"><i class="la la-folder-open"></i> &nbsp;Loan Repayment Records</a>
              </li>
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane {{$balance}}" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
                aria-expanded="true">





<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
  
  <div class="group col-md-6  offset-md-3">


    @if (isset($current_loan_repay))

   @php 

    $loan_info  = LoanController::loan_info($current_loan_repay->loan_id);
    $date = date('Y-m-d',time());
    
    $repay_date  = date('Y-m-d', strtotime($current_loan_repay->repayment_date));
@endphp

 <?php
  $today = date('d');
 $repay_day  = date('d',strtotime($current_loan_repay->repayment_date));


$date1=date_create($date);
$date2=date_create($repay_date);
  $diff=date_diff($date1,$date2);
if ($repay_day > $today) {
 
   if ($diff->days == 0) {
    $ndate = 'today';
  } elseif ($diff->days == 1) {
      $ndate = 'tomorrow';
  
  }else{

    $ndate =$diff->days.' days to go';
  }
}else{
  if ($diff->days == 0) {
    $ndate = 'today';
  } elseif ($diff->days == 1) {
      $ndate = 'yesterday';
  
  }else{

    $ndate =$diff->days.' days ago';
  }
}
?>
   

    @foreach($loan_info as $loan_info)
   @endforeach


    <ul class="list-group">
       <li class="list-group-item"> 
        <h3 class="text-center">Current Loan Status : <span class="badge badge-success">{{$current_loan_repay->status}}</span></h3></li>
          <li class="list-group-item">Repayment Date: <span class="badge badge-primary pull-right" style="font-size: 15px;">{{$ndate}} </span> </li>
           <li class="list-group-item">Loan ID: <span class="text-primary pull-right" style="font-size: 15px;">{{$current_loan_repay->loan_id}}</span> </li>
        <li class="list-group-item">Principal : <span class="text-primary pull-right" style="font-size: 15px;">
          ₦{{$loan_info->loan_amount}}
        </span> </li>
        <li class="list-group-item">Tenure(Months): <span class="text-primary pull-right" style="font-size: 15px;">{{$loan_info->loan_tenure}}</span> </li>
        <li class="list-group-item">Monthly Repayment: <span class="text-primary pull-right" style="font-size: 15px;">₦{{$current_loan_repay->repayment_amount}}</span> </li>
        <li class="list-group-item">Total Remian: <span class="text-primary pull-right" style="font-size: 15px;">₦{{$current_loan_repay->total_repayment}}</span> </li>

         <li class="list-group-item">Total Paid: <span class="text-primary pull-right" style="font-size: 15px;">₦{{$loan_info->loan_amount - $current_loan_repay->total_repayment }}</span> </li>
       
       @if($current_loan_repay->status =='approved')
        
                    

       @endif

    </ul>
 
   @else

   <div>
     <ul class="list-group">
        <li class="list-group-item"> Your current loan repayment will appears here..</li>
     </ul>
   </div>
  @endif
   </div>
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
                        <th>Principal (₦)</th>
                        <th>Loan Tenure(Months)</th>
                        <th>Loan Repaid Amount(₦)</th>
                        <th>Repayment Date</th>
                        <th>Repaid Date</th>
                   
                  
                    </tr>
                </thead>
                <tbody>

                  @if(isset($user_loan_repayments))
                  @php $srn = 0; @endphp
                  @foreach($user_loan_repayments as $data)


                     @php $srn ++; 
                   
                    $loan_info  = LoanController::loan_info_list_mandate($data->mandate_id);

                     @endphp


                       
                    
                 
                    <tr>
                      <td>{{$srn}}</td>
                     
                      <td> <?php  if ($loan_info) {
                           echo $loan_info->loan_id;
                      } ?></td>
                      <td> <?php  if ($loan_info) {
                           echo  number_format($loan_info->loan_amount,2);
                      } ?></td>
                      <td> <?php  if ($loan_info) {
                           echo $loan_info->loan_tenure;
                      } ?></td>
                      <td>{{ number_format($data->amount,2)}}</td>
                
                      <td><?php  if ($loan_info) {
                           echo $loan_info->created_at;
                      } ?></td>
                       <td><?php  echo $data->created_at;  ?></td>
                       
                      <!--   <td>
                          <span class="dropdown">
                                <button id="btnSearchDrop28" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop28" class="dropdown-menu mt-1 dropdown-menu-right">
                                    <a href="#" class="dropdown-item"><i class="la la-eye"></i> Open Task</a>
                                    <a href="#" class="dropdown-item"><i class="la la-pencil"></i> Edit Task</a>
                                    <a href="#" class="dropdown-item"><i class="la la-check"></i> Complete Task</a>
                                    <a href="#" class="dropdown-item"><i class="ft-upload"></i> Assign to</a>
                                    <a href="#" class="dropdown-item"><i class="la la-trash"></i> Delete Task</a>
                                </span>
                            </span>
                        </td> -->
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




       @endif

               
            </div>
        </div>
    </div>
</section>
<!-- Form wizard with icon tabs section end -->


@endsection