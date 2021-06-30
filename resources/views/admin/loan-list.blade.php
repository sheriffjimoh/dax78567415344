@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\LoanController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card">
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



                <div class="card-header">
                    <h4 class="card-title float-left">

                     All Loan Records
                    </h4>
                    <div class="float-right">
                      <!--   <a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right white" href="bank-add-loan.html">
                            <i class="ft-plus white"></i>Add New Loan
                        </a> -->
                    </div>
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table   id="example1" class="table alt-pagination  loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Loan ID</th>
                                    <th class="border-top-0">Customer ID</th>
                                   
                                    <th class="border-top-0">Principal (₦)</th>
                                    <th class="border-top-0">Tenure(Months) </th>
                                    <th class="border-top-0">Interest (5%)(₦)</th> 
                                    <th class="border-top-0">Repayment Amount(₦)</th>
                                    <th class="border-top-0">Total Repayment(Interest+Principal)(₦)</th>
                                    <th class="border-top-0">Repayment Date</th>
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($data)) {
                                $srn =0;

                                foreach ($data as $value) {
                            
                           $user_loans = $value->loans;
                          // $user_loans->loan_amount;
                       $user_data = $value->registration; 
                          foreach ($user_loans as $loan) {
                           $loan->loan_tenure;

                            $user_repayments =  $value->repayments;

                            foreach ($user_repayments as $repayment ) {
                             
                               }
                           $srn ++;
                            
                              if ( ! empty($repayment->repayment_amount)) {
                           $repay_amount = number_format($repayment->repayment_amount ,2);
                           $repay_date = $repayment->repayment_date; 
                            }else{
                              $repay_amount = 0;
                              $repay_date = 0;
                            }



                                  $tenure = $loan->loan_tenure;
                                  $principal = $loan->loan_amount;
                                 $interest= ceil(LoanController::Interest($tenure, $principal));  

                                 $repayment= ceil(LoanController::Repayment($tenure, $principal)); 
                                 $total_repayment= ceil(LoanController::Totalrepayment($tenure, $principal)); 
                                
                           ?>

                                <tr>
                                     <td class="align-middle">
                                        <div class="loan-id">{{$srn}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$loan->loan_id}}</div>
                                    </td>
                                    <td class="align-middle">
                                     <a href="user-view/{{$user_data->user_id}}">
                                        <div class="user_code">{{$user_data->user_code}}</div>
                                      </a>
                                    </td>
                                   
                                    
                                    <td class="align-middle">
                                        <div class="amount">{{ number_format($loan->loan_amount,2)  }}</div>
                                    </td>
                                      <td class="align-middle">
                                       
                                        <div class="tenure">{{$loan->loan_tenure }}</div>
                                      
                                       
                                    </td>
                                      <td class="align-middle">
                                        <div class="interest">{{  number_format($interest ,2)}}</div>
                                    </td> <td class="align-middle">
                                        <div class="borro-name">{{  $repay_amount }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="borro-name">{{  number_format($total_repayment ,2) }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="borro-name">{{ $repay_date }}</div>
                                    </td>
                                    <td class="align-middle">
                                      @if($loan->status =='reject')
                                     <div class="loan-status badge badge-danger badge-pill badge-sm">{{$loan->status}}</div>

                                      @endif
                                    @if($loan->status =='approved')
                                        <div class="loan-status badge badge-primary badge-pill badge-sm">{{$loan->status}}</div>
                                        @endif

                                           @if($loan->status =='review')
                                        <div class="loan-status badge badge-info badge-pill badge-sm">{{$loan->status.'ing'}}</div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="action">
                                            <!-- <a href="user_preview/{{$loan->id}}" ><i class="la la-eye primary"></i></a> -->
                                            <a href="deleteloan/{{$loan->id}}" onclick="return confirm('are you sure you want to delete?')" ><i class="la la-trash danger"></i></a>
                                        </div>
                                    </td>
                                </tr>


                               <?php  } } }  ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
