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


        @if (isset($current_loan))

      <?php foreach ($current_loan as $current_loan) {
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
          <h4 class="card-title">Current Loan, Loan records</h4>
           <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
        </div>
        <div class="card-content">
          <div class="card-body">
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link {{$balance}}" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                  aria-controls="activeIcon1" aria-expanded="true"><i class="la la-money"></i> &nbsp;Current Loan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{$setwithdraw}}" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                  aria-expanded="false"><i class="la la-folder-open"></i> &nbsp;Loan Records</a>
              </li>
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane {{$balance}}" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
                aria-expanded="true">





<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
  
  <div class="group col-md-6  offset-md-3">
     @if ($current_loan)
    <ul class="list-group">
       <li class="list-group-item"> 
        <h3 class="text-center">Current Loan Status : <span class="badge badge-success">
              @if($current_loan->status =='new')
                    pending
              @else
{{$current_loan->status}}
              @endif
          </span></h3></li>
           <li class="list-group-item">Loan ID: <span class="text-primary pull-right" style="font-size: 15px;">{{$current_loan->loan_id}}</span> </li>
        <li class="list-group-item">Amount request : <span class="text-primary pull-right" style="font-size: 15px;">
          ₦{{$current_loan->loan_amount}}
        </span> </li>
        <li class="list-group-item">Tenure(Months): <span class="text-primary pull-right" style="font-size: 15px;">{{$current_loan->loan_tenure}}</span> </li>
        <li class="list-group-item">Repayment Amount(monthly) <span class="text-primary pull-right" style="font-size: 15px;">₦

         {{ ceil(LoanController::Repayment($current_loan->loan_tenure, $current_loan->loan_amount))}}</span> </li>
       
       @if($current_loan->status =='approved')
        
                     @php 
                          $interest= ceil(LoanController::Interest($current_loan->loan_tenure, $current_loan->loan_amount));  

                                 $repayment= ceil(LoanController::Repayment($current_loan->loan_tenure, $current_loan->loan_amount)); 
                                 $total_repayment= ceil(LoanController::Totalrepayment($current_loan->loan_tenure, $current_loan->loan_amount));

                      @endphp

        <li class="list-group-item">Interest : <span class="text-primary pull-right" style="font-size: 15px;">₦{{$interest}}</span> </li>
         
        <li class="list-group-item">Total Repayment : <span class="text-primary pull-right" style="font-size: 15px;">₦{{ $total_repayment}}</span> </li>

       @endif

    </ul>
    @else

     <ul class="list-group">
        <li class="list-group-item"> Your current loan will appears here..</li>
     </ul>
 
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
                        <th>Principal</th>
                        <th>Loan Tenure(Months)</th>
                        <th>Status</th>
                        <th>Loan Repayment Amount(₦)</th>
                        <th>Loan Interest(₦)</th>
                        <th>Total Repayment(Interest+principal)(₦)</th>
                        <!-- <th> Repayment Date</th> -->
                  
                    </tr>
                </thead>
                <tbody>

                  @if($user_loans)
                  @php $srn = 0; @endphp
                  @foreach($user_loans as $data)


                     @php $srn ++; 
               $userloans = $data->loans;
                     @endphp
                  @foreach($userloans as $loans_data)

                     @php $srn ++;

                          $interest= ceil(LoanController::Interest($loans_data->loan_tenure, $loans_data->loan_amount));  

                                 $repayment= ceil(LoanController::Repayment($loans_data->loan_tenure, $loans_data->loan_amount)); 
                                 $total_repayment= ceil(LoanController::Totalrepayment($loans_data->loan_tenure, $loans_data->loan_amount));

                      @endphp
                    <tr>
                        <td>{{$srn}}</td>
                        <td>{{$loans_data->loan_id}}</td>
                        <td>{{$loans_data->loan_amount}}</td>
                        <td>{{$loans_data->loan_tenure}}</td>
                        <td>
                          @if($loans_data->status == 'approved')

                          <span class="badge badge-success badge-lg">{{$loans_data->status}}</span>
                          @elseif($loans_data->status == 'reject')
                           
                          <span class="badge badge-danger badge-lg">{{$loans_data->status}}</span>
                          @elseif ($loans_data->status == 'review')
                          
                          <span class="badge badge-info badge-lg">{{$loans_data->status}}</span>
                          @elseif ($loans_data->status == 'new')
                           <span class="badge badge-info badge-lg"> {{'pending'}}    </span>
                          @else

                              <span class="badge badge-info badge-lg"> {{$loans_data->status}}    </span></td>
                           @endif
                        <td>{{$repayment}}</td>
                        <td>{{$interest}}</td>
                        <td>{{ $total_repayment}}</td>
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
                        <th>Loan Interest</th>
                        <th>Total Repayment(Interest+principal)</th>
                        <!-- <th> Repayment Date</th> -->
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