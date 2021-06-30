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

                       
                      New Custmers  Loan Applications
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
                                    <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure </th>
                                    <th class="border-top-0">Interest (5%)</th>
                                    <th class="border-top-0">Monthly Repayment</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($users)) {

                                foreach ($users as $user) {
                            
                         

                                  $tenure = $user->loan_tenure;
                                  $principal = $user->loan_amount;
                                 $interest= ceil(LoanController::Interest($tenure, $principal));  

                                 $repayment= ceil(LoanController::Repayment($tenure, $principal)); 
                           ?>

                                <tr>
                                    <td class="align-middle">
                                        <div class="loan-id">{{$user->user_code}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="borro-name">{{$user->firstname. ' '. $user->lastname}}</div>
                                    </td>
                                    
                                    <td class="align-middle">
                                        <div class="amount">{{'₦'. $user->loan_amount}}</div>
                                    </td>
                                    <td class="align-middle">
                                        @if($user->loan_tenure > 1)
                                        <div class="tenure">{{$user->loan_tenure.' Months' }}</div>
                                        @endif
                                        @if($user->loan_tenure == 1)
                                        <div class="tenure">{{$user->loan_tenure.' Month' }}</div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="interest">{{'₦'. $interest}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="loan-status">{{'₦'. $repayment}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="action">
                                            <a href="user_preview/{{$user->user_id}}" ><i class="la la-eye primary"></i></a>
                                            <a href="user_delete/{{$user->user_id}}"><i class="la la-trash danger"></i></a>
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
    </div>
</section>


@endsection
