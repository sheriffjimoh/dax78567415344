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
          
          	 <?php //echo $year ?>
          
          </div>
        


        </div>


        <section id="minimal-statistics">
 
  <div class="row">
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
                <i class="ft-list primary font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$count_portfolio ?? 0}}</h3>
                <span><a href="/portfolios">Investment </a></span>
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
                <i class="la la-money primary font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>₦ {{ number_format($investment_amount,2)  ?? 0}}</h3>
                <span><a href="/portfolios">Investment Amount</a> </span>
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
                <i class="ft-layers success font-large-2 float-left"></i>
              </div>
              <div class="media-body text-right">
                <h3>{{$count_matured ?? 0}}</h3>
                <span><a href="/matured"> Matured </a> </span>
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
                <h3>₦ {{($my_balance) ? number_format($my_balance,2) : 0}}</h3>
                <span><a href="/wallet"> Wallet Balance  </a> </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-3 col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="primary">₦ {{($monthly_investment) ? number_format($monthly_investment,2) : 0}}</h3>
                <span class="info"> Monthly's Investment</span>
              </div>
              <div class="align-self-center">
                <i class="icon-cup primary font-large-2 float-right"></i>
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
                <h3 class="success">₦ {{($monthly_interest) ? number_format($monthly_interest,2) : 0}}</h3>
                <span class="info">Monthly's Interest</span>
              </div>
              <div class="align-self-center">
                <i class="icon-graph success font-large-2 float-right"></i>
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
                <h3 class="warning">{{($max_rate) ? $max_rate : 0}} %</h3>
                <span class="info">Highest Rate</span>
              </div>
              <div class="align-self-center">
                <i class="icon-pie-chart warning font-large-2 float-right"></i>
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
                <h3 class="info">₦ {{($max_invested) ? number_format($max_invested,2) : 0}}</h3>
                <span class="info">Highest A.I</span>
              </div>
              <div class="align-self-center">
                <i class="icon-support info font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  </div>
</section>

    <div class="card">
       <div class="card-content">
        <div class="card-header">
             <ul id="user-legend" class="pull-left">
            <li>
             Investment <span class="badge badge-default" style="background-color:#9B8A87;   padding: 5px; display: block;"></span>
            </li> 
            <li>
              Interest <span class="badge badge-default" style="background-color:#022b69;  padding: 5px; display: block;"></span> </li> 
            
          </ul>
          <div class="pull-right">
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
   <div style="width:95% ; padding:20px;">
       <div>
        <canvas id="canvas" height="250" width="600"></canvas>
      </div>
    </div>

       </div>
     </div>
   </div>
</section>



@endsection
