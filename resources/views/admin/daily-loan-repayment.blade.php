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
                        List of Today's  Repayment 
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
                                    <th class="border-top-0">Principal(₦)</th>
                                    <th class="border-top-0">Tenure (Months)</th>
                                    <th class="border-top-0">Interest (5%)</th>
                                    <th class="border-top-0">Loan Approved Date</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>

                                       <?php 

                            if (isset($data)) {
                                $srn =0;

                                foreach ($data as $value) {

                                 $userloan = LoanController::getCustomerLoan($value['loan_id'],$value['user_id']);

                                 $interest = ceil(LoanController::Interest($userloan['loan_tenure'], $userloan['loan_amount'])); 
                                 $user_loan_id[]=$value['loan_id'];
                           ?>
                                <tr>
                                 
                                 <td><?php echo $value['loan_id']?></td>
                                 <td><?php echo $userloan['user_code']?></td>
                                 <td><?php echo $userloan['name'] ?></td>
                                 <td><?php echo $value['repayment_amount']?></td>
                                 <td><?php echo $value['repayment_date']?> <span class="badge badge-success">Today</span></td>
                                 <td><?php echo $value['status']?></td>
                                 <td><?php echo $userloan['loan_amount'] ?></td>
                                 <td><?php echo $userloan['loan_tenure'] ?></td>
                                 <td><?php echo $interest ?></td>
                                 <td><?php echo $userloan['created_at'] ?></td>
                                 <td><a href="/markrepayment/{{ $value['loan_id']}}" id="btn-paid" class="btn btn-primary">Mark</a></td>
                                </tr>
                                    
                            <?php }   ?>
                            <tr>
                              <td > 
                              <?php if (count($data) > 0) {?>
                             <a href="/markall" class="btn btn-primary">Mark&nbsp;&nbsp;all</a>
                               <?php } ?>
                             </td>
                              <td></td>
                               <td></td>
                                <td></td>
                                 <td></td>
                                  <td></td>
                                   <td></td>
                                    <td></td>
                                     <td></td>
                                      <td></td>
                                       <td></td>
                                        <td></td>

                           
                            </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
