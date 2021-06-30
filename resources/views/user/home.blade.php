@extends('layouts.app_header')

@section('content')




<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
 
 

  <div class="row card-icons">
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
        <div class="card-content">
          <div class="">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="media d-flex p-2">
                  <div class="align-self-center">
                    <i class="la la-book font-large-1 blue-grey d-block mb-1"></i>
                    <a href="/user_loans_review"><span class="text-muted text-right">Loan  Review</span></a>
                    
                  </div>
                  <div class="media-body text-right">
                    <span class="font-large-2 text-bold-300 info">{{($count_review) ? $count_review : 0 }}</span>
                  </div>
                </div>
                
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="media d-flex p-2">
                  <div class="align-self-center">
                    <i class="la la-close  font-large-1 blue-grey d-block mb-1"></i>
                    <a href="/user_loans_rejected"> <span class="text-muted text-right">Loan Rejected</span></a>
                   
                  </div>
                  <div class="media-body text-right">
                    <span class="font-large-2 text-bold-300 danger">{{($count_rejected) ? $count_rejected : 0 }}</span>
                  </div>
                </div>
                
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="media d-flex p-2">
                  <div class="align-self-center">
                    <i class="la la-check font-large-1 blue-grey d-block mb-1"></i>
                    <a href="/user_loans"> <span class="text-muted text-right">Loan Approved</span></a>
                   
                  </div>
                  <div class="media-body text-right">
                    <span class="font-large-2 text-bold-300 success">{{($count_approved) ? $count_approved : 0 }}</span>
                  </div>
                </div>
               
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="media d-flex p-2">
                  <div class="align-self-center">
                    <i class="ft-battery-charging font-large-1 blue-grey d-block mb-1"></i>
                    <span class="text-muted text-right">Current Loan Status</span>
                  </div>
                  <div class="media-body text-right">
                    <span class="font-large-1 text-bold-100 warning">{{$loan_status->status}}</span>
                  </div>
                </div>
               
              </div>
            </div>


          </div>
        </div>
      </div>
  <!--   </div>
  </div>

  </div> -->
</section>
<!-- // grouped card stats section end -->











<!-- stats with icon, subtitle & bg gradient color section start -->
<section id="stats-icon-subtitle-bg-1">
 <div class="">
  <div class="row">

    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch bg-gradient-x-success text-white rounded">
            <div class="p-2 media-middle">
              <h1 class="text-white">₦{{($wallet_balance) ? number_format($wallet_balance->balance,2) : number_format(0,2)}}</h1>
            </div>
            <div class="media-body p-2">
              <a href="/mywallet" class="text-white">
              <h4 class="text-white">Naira Wallet</h4>
              <span> Available to withdraw</span></a>
            </div>
            <div class="media-right p-2 media-middle">
              <i class="icon-wallet font-large-2 text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </div>






    <div class="col-xl-6 col-md-12">
      <div class="card overflow-hidden">
        <div class="card-content">
          <div class="media align-items-stretch bg-gradient-x-info text-white rounded">
            <div class="p-2 media-middle">
              <i class="icon-pencil font-large-2 text-white"></i>
            </div>
            <div class="media-body p-2">
              <a href="/user_loans_repayments" class="text-white"><h4 class="text-white">Loan Repayment</h4>
              <span>Monthly pays</span></a>
              
            </div>
            <div class="media-right p-2 media-middle">
              <h1 class="text-white">₦{{($monthly_repayment) ? number_format($monthly_repayment->repayment_amount ,2) : number_format(0,2)}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

   
  </div>

  <div class="row">

    <?php if ($loan_pay > 0 ) {?>
    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch bg-gradient-x-warning text-white rounded">
            <div class="p-2 media-middle">
              <h1 class="text-white">₦{{($loan_pay) ? number_format($loan_pay ,2) : number_format(0,2)}}</h1>
            </div>
            <div class="media-body p-2">
              <h4 class="text-white">Loan Repayment</h4>
              <span>Today </span>
            </div>
            <div class="media-right p-2 media-middle">
              <i class="icon-equalizer font-large-2 text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>
     <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="media align-items-stretch bg-gradient-x-warning text-white rounded">
            <div class="p-2 media-middle">
              <i class="icon-equalizer font-large-2 text-white"></i>
            </div>
            <div class="media-body p-2">
              <h4 class="text-white">Loan Repayment</h4>
              <span>Overdue</span>
            </div>
            <div class="media-right p-2 media-middle">
              <h1 class="text-white">₦ {{($loan_overdue) ? number_format($loan_overdue ,2) : number_format(0,2)}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- </div> -->
</section>
<!-- // stats with icon, subtitle & bg gradient color section end -->






 <!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
  <div class="container-fluid">
   <div class="row">
     <div class="card col-lg-6">
       <div class="card-header">
        <h3>Transaction Log</h3>
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
           <div class="table-responsive">
           <table id="example1" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Trancaction Type</th>
                        <th>Mandate ID</th>
                        <th>Date</th>
                  
                    </tr>
                </thead>
                <tbody>

                  @if(isset($transact))
                  @php $srn = 0; @endphp
                  @foreach($transact as $data)


                     @php $srn ++;

                       @endphp

                        <tr>
                          <td>{{$srn}}</td>
                          <td>
                            {{$data->transaction_id}}
                          </td>
                          <td>
                            {{$data->amount}}
                          </td>
                          <td>
                            {{$data->transaction_type}}
                          </td>
                           <td>
                            {{$data->mandate_id}}
                          </td>
                          <td>
                            {{$data->created_at}}
                          </td>
                        </tr>
                  
                     @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                          <th>#</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Trancaction Type</th>
                        <th>Mandate ID</th>
                        <th>Date</th>
                    
                    </tr>
                </tfoot>
          </table>
          </div>
          <!--/ Invoices table -->
        </div>
       </div>
     </div>
     <div class="card col-lg-6">
        <div class="card-header">
          <div class="row">
          <div class="pull-left">
            <div>
             <h3 class="card-title">Transaction Chart </h3>
            
            </div>
            <br>
            <br>
          <div class="pull-left">
               <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
          </div>
   
          </div>
                    <ul id="user-legend" class="pull-right">
            <li> Disburstment
              <span style="padding: 5px; display: block;">₦ {{($disburstment_chart) ? number_format($disburstment_chart,2):0 }}</span>
              <span class="badge badge-default" style="background-color:#022b69;  padding: 5px; display: block;"></span>
            </li> 
            <li>
              Repayment 

            
              <span style="padding: 5px; display: block;">₦ {{($repayment_chart) ? number_format($repayment_chart,2):0 }}</span>
              <span class="badge badge-default" style="background-color:#FDB45C;  padding: 5px; display: block;"></span>

          <!-- 
              <span class="badge badge-default" style="background-color:#FDB45C; padding: 5px; display: block;">{{$repayment_chart}}</span> -->
            </li> 
            <li>
             Withdraw 

             <span style="padding: 5px; display: block;">₦ {{($withdraw_chart) ? number_format($withdraw_chart,2):0 }}</span>
             <span class="badge badge-default" style="background-color:#F7464A;  padding: 5px; display: block;"></span>


            <!--  <span class="badge badge-default" style="background-color:#F7464A; padding: 5px; display: block;">{{$withdraw_chart}}</span> -->
            </li> 
          </ul>

       

          </div>
        </div>
        <div class="card-body">
           <div id="canvas-holder" style="width:90%">
          <canvas id="chart-area" width="300" height="300"/>
         </div>
        </div>
     </div>
   </div>

                    <!-- Invoices List table -->
</section>











@endsection
















