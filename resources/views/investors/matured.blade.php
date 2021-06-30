@extends('layouts.app_header')

@section('content')
     <section id="grouped-stats" class="grouped-stats">      <!-- session message -->
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

  <div class="card  " >
  	<div class="card-header">
  	
    <h3 class="card-title">Investment Portfolio(matured)</h3>
    
    <br>
    <div id="msg">
      
    </div>
     <div class="heading-elements">
                          <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                              <li><a data-action="close"><i class="ft-x"></i></a></li>
                          </ul>
                      </div>


  	</div>

    <div class="card-body">
        
  <div class="col-12 col-md-12">
    <div class="card">
      <!-- <div class="card-header">
        <h4 class="card-title text-center">Average Deal Size</h4>
      </div> -->
      <div class="card-content collapse show">
        <div class="card-body pt-0">
          <div class="row">


           
             <?php if (isset($data)) { foreach ($data as $val) { ?>


            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center md-5">
               <h6 class="danger text-bold-600 p-1"><span class="bg-danger text-white">matured</span></h6>
              <h6 class="danger text-bold-600">+ {{ $val->rate}}%</h6>
              <h4 class="font-large-2 text-bold-400">₦ {{ number_format($val->amount,2) }}</h4>
              <h6 class="success text-bold-600"> ₦ {{ number_format(ceil($val->monthly_payment),2) }}</h6>
              <p class="blue-grey lighten-2 mb-0">Per month</p>
              <hr>

               <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#col<?php echo $val->investment_id ?>" aria-expanded="false" aria-controls="collapseExample">
                 <i class="la la-eye"></i>
                </button>
                 <hr>

               <div class="collapse" id="col<?php echo $val->investment_id ?>">
                  <div class="card card-body port-d"> 
                    <ul class="list-group">
                   <li>Amount <i class="la la-arrow-right"></i>  ₦ {{number_format($val->amount,2)}}</li>
                   <li>Tenor(days) <i class="la la-arrow-right"></i> {{$val->tenure*30}}</li>
                   <li>Rate <i class="la la-arrow-right"></i> % {{$val->rate}} </li>   
                   <li>Interest Per Month <i class="la la-arrow-right"></i> ₦ {{number_format(ceil($val->monthly_payment),2)}} </li> 
                   <li>Total Interest <i class="la la-arrow-right"></i> ₦ {{number_format(ceil($val->interest*$val->tenure),2)}} </li>
                    <li>Total<i class="la la-arrow-right"></i> ₦ {{number_format(ceil($val->amount+$val->interest),2)}} </li>
                   <li>Started Date <i class="la la-arrow-right"></i> {{$val->start_date}} </li>
                   <li>Matured Date <i class="la la-arrow-right"></i>{{$val->end_date}} </li>

                    </ul>
                  </div>
                </div>
             </div>
    
           <?php } } ?>

           



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>

</div>


</section>

<script src="https://js.paystack.co/v1/inline.js"></script> 

@endsection














  