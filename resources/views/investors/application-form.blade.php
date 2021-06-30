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
  	@if(isset($data))
    <h3 class="card-title">Investment Details</h3>
    <br>
    <p>if the approve process took longer than 2days kindly contact <a href="">Tomxcredit support</a>  </p>
    @else
    <h3 class="card-title">Create New Investment</h3>
    @endif
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
  @if(isset($data))
    <div class="card-body offset-lg-4 col-md-4">
        <ul class="list-group">
          <li class="list-group-item">Amount:  <span class="pull-right">₦  {{number_format($data->amount,2)}}</span> </li>
          <li class="list-group-item">Tenor(days):  <span class="pull-right">{{$data->tenure*30}}</span> </li>
          <li class="list-group-item">Rate(monthly):  <span class="pull-right">% {{$data->rate}}</span> </li> 
           <li class="list-group-item">Interest(monthly):  <span class="pull-right">₦ {{ number_format($data->interest,2)}}</span> </li>
           <li class="list-group-item">Total-Interest:  <span class="pull-right">₦ {{ number_format($data->interest*$data->tenure,2)}}</span> </li>
          <li class="list-group-item">Total:  <span class="pull-right">₦ {{ number_format($data->total,2)}}</span> </li>
           <li class="list-group-item">Payment-Method:  <span class="pull-right">{{$data->payment_method}}</span> </li>
          <li class="list-group-item">Status:  <span class="pull-right"> {{$data->status}}</span> </li>
          @if($data->payment_method =='transfer')
          <li class="list-group-item">
            Attachment
            <br>
         <div class="zoom">
            <img src="{{ url('storage/investment_doc/'.$data->file)}}"  width="250px"></div>
</li>
          @endif
        </ul>
    </div>

    @else
    	<div class="card-body offset-lg-4 col-md-4 bg-primary">
    	    <form action="/create_investment_application"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
              <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">
                       
                            <fieldset>
                                <div class="row">
                                   
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-white">Amount</label>
                                            <input type="text" class="form-control"   name="amount"  id="amount" autocomplete="off">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-white">Tenor</label>
                                             <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="tenure" name="tenure">
                                    <option selected="" value="" disabled>Select Tenor</option>
                                   <option value="1">30 days</option>
                                    <option value="2">60 days</option>
                                    <option value="3">90 days</option>
                                    <option value="4">180 days</option>
                                    <option value="5">270 days</option>
                                    <option value="6">360 days</option>
                                
                                </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="interest-repay">
                                        <div class="form-group bg-white p-1" >
                                           <label class="text-primary text-sm" id="n_rate"> </label>
                                             <br>
                                            
                                            <label class="text-primary" id="n_interest_month"> </label>
                                             <br>
                                            <label class="text-primary" id="n_interest"> </label>
                                            
                                            <br>
                                            <label class="text-primary" id="n_principal"> </label>
                                            <br>
                                             <label class="text-primary" id="n_total_repayment"> </label>
                                        
                                        </div>
                                         
                                    </div>
                                  </div>
                               

                            </fieldset>

                               <fieldset>
                                <div class="row">
                                   
                                
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-white">Method of Payment</label>
                                             <select aria-label="payment" aria-describedby="basic-addon1" class="form-control " id="payment" name="payment">
                                    <option selected=" " value=" " disabled>Select Method Of Payment</option>
                                   <option value="card">Pay with Card</option>
                                    <option value="transfer">Transfer</option>
                                
                                </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="account-details">
                                        <div class="form-group bg-white p-1" >
                                          <p class="text-info">please pause this process to make payment and upload your payment proof/receipt</p>
                                            <label class="text-primary">Account Number: 0253824896</label>
                                            <br>
                                             <label class="text-primary">Account Name: Jimoh sherifdeen</label>
                                             <br>
                                              <label class="text-primary">Bank Name: GT</label>

                                              <div class="form-group input-file-style" >
                                            <label class="btn btn-primary">Upload Proof
                                            <input type="file" class="form-control  invest-file"   name="file"  id="files" autocomplete="off">
                                              </label>
                                            </div>
                                              <span id="display-files"></span>

                                      
                                        </div>
                                    
                                    </div>
                                  </div>
                               

                            </fieldset>

                            
                             <fieldset>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group " id="submit-handover"> 
                                            <input type="submit" class="btn btn-block btn-primary bd-white"  value="Submit"  
                                            id="i_btn">
                                        </div>
                                    </div>

                                    
                                </div>

                            </fieldset>
    	</div>


      @endif
</div>


</section>

<script src="https://js.paystack.co/v1/inline.js"></script> 

@endsection














