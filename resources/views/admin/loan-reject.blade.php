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
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Amount (₦)</th>
                                    <th class="border-top-0">Tenure (Months)</th>
                                    <th class="border-top-0">Interest (5%)</th>
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
                                        <div class="loan-status badge badge-primary badge-pill badge-sm">{{$value->status.'ed'}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="amount">{{'₦'.$value->loan_amount}}</div>
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
        </div>
    </div>
</section>


@endsection
