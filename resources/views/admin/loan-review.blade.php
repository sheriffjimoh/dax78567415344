@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\LoanController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card">
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

                       
                      Reviewed  Loan Applications
                    </h4>
                    <div class="float-right">
                     
                    </div>
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table   id="example1" class="table alt-pagination  loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Loan ID</th>
                                    <!-- <th class="border-top-0">Customer Name</th> -->
                                    
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

                            if (isset($datas)) {

                                foreach ($datas as $data) {
                             
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
    </div>
</section>


@endsection
