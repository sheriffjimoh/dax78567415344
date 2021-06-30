@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\LoanController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Loan Disbursement
                    </h4>
                   <!--  <div class="float-right">
                        <a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right white" href="bank-add-loan.html">
                            <i class="ft-plus white"></i>Add New Loan
                        </a>
                    </div> -->
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table id="example1" class="table alt-pagination loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Loan ID</th>
                                     <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Borrower Name</th>
                                     <th class="border-top-0">Loan Repayment Amount(₦)</th>
                                      <th class="border-top-0">Loan Repayment Date</th>
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure (Months)</th>
                                    <th class="border-top-0">Interest (5%)(₦)</th>
                                    <th class="border-top-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                       <?php 

                            if (isset($data)) {
                                $srn =0;

                                foreach ($data as $value) {
                                 
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
                                        <div class="borro-name">
                                              <a href="user-view/{{$value->user_id}}">{{$value->firstname.''.$value->lastname}}</a>
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
                                        <div class="amount">{{ $value->loan_amount}}</div>
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
                                        <div class="interest">{{ $interest}}</div>
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
        </div>
    </div>
</section>


@endsection
