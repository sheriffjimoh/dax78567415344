@extends('layouts.app_header')

@section('content')

<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
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
 



 <section id="minimal-statistics">
 
  <div class="row">

    <?php if ($count_new_customer > 0) {?>

   <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="icon-user danger font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$count_new_customer ?? 0}}</h3>
                <a href="/new_customers"><span>New Customer </span></a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>

    <?php if ($new_inv_application > 0) {?>
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="icon-cup danger font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$new_inv_application ?? 0}}</h3>
                <a href="/investment-applications"><span>New Application</span></a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <?php if ($new_loan_application > 0) {?>
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="la la-money danger font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$new_loan_application ?? 0}}</h3>
                 <a href="/loan-application"><span>New Application - Loan</span></a>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>
        <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="icon-equalizer danger font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$today_repay ?? 0}}</h3>
                <a href="/repay_day"><span>Today's Repay- Loan</span></a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="icon-equalizer danger font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$overdue_repay     ?? 0}}</h3>
                <a href="/overdue"><span>Overdue Repay - Loan</span></a>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="la la-bank info font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>₦ {{ $investment_wallet ?? 0}}</h3>
                <a href="/investment-wallet"><span>Wallet Balance </span></a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="la la-bank info font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>₦ {{ $loan_wallet ?? 0}}</h3>
                <a href="/loan-wallet"> <span>Wallet Balance - Loan </span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


      <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="primary">₦ {{$today_repay_amount ?? 0 }}</h3>
                 <a href="/repay_day"><span>Today's Repay- Loan</span></a>
               
              </div>
              <div class="align-self-center">
                <i class="icon-equalizer primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="primary">₦ {{$overdue_repay_amount ?? 0 }}</h3>
                <a href="/overdue"><span>Overdue Repay- Loan</span></a>
              </div>
              <div class="align-self-center">
                <i class="icon-equalizer primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

       <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="success"> {{ $count_borrower ?? 0 }}</h3>
                <a href="/all_customer"> <span>Borrowers</span></a>
               
              </div>
              <div class="align-self-center">
                <i class="icon-user success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

  <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="success">{{ $count_investor ?? 0 }}</h3>
                <a href="/investment_customers"><span>Investors</span></a>
                
              </div>
              <div class="align-self-center">
                <i class="icon-user success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></div>

     <div class="row">
  
<!--     <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="success"> {{$monthly_interest ?? 0}}</h3>
                <span>Borrowers</span>
              </div>
              <div class="align-self-center">
                <i class="icon-user success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 -->
   
  <!--   <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="info">₦ 45.56</h3>
                <span>Highest A.I</span>
              </div>
              <div class="align-self-center">
                <i class="icon-support info font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>



</section>


  <div class="row card-icons">
    <div class="col-12">
      <div class="card">
      	        


   <!-- Chart -->
          <div class="card-content">
            <div class="pull-right" style="padding: 10px;">
               <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year_a">
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
          
          	<div class="chart" style="padding:20px;">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          
        

        <hr>
         <div style="width: 95%; padding:20px;">

            <ul id="user-legend" class="pull-left">
            <li>
             Investment <span class="badge badge-default" style="background-color:#9B8A87;   padding: 5px; display: block;"></span>
            </li> 
            <li>
              Interest <span class="badge badge-default" style="background-color:#022b69;  padding: 5px; display: block;"></span> </li> 
            
          </ul>
      <canvas id="next-c" height="250" width="600"></canvas>
      </div>


</div>
        </div>
     </div>
   </div>
</section>



@endsection
