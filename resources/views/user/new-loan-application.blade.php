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
  		
    <h3 class="card-title">Apply for new Loan</h3>
    
     <div class="heading-elements">
                          <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                              <li><a data-action="close"><i class="ft-x"></i></a></li>
                          </ul>
                      </div>
  	</div>
    	<div class="card-body offset-lg-4 col-md-4 bg-primary">
                     <?php if ($data) { ?>
    <p >You currently have a running loan you will not be able to create now, thank.</p>
  <?php  }else{ ?>
       
    	    <form action="/loan_request"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                            <fieldset>
                                <div class="row">
                                   
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-white">Loan Amount</label>
                                            <input type="text" class="form-control"   name="loan_amount"  id="new_loan_amount" autocomplete="off" required="">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-white">Loan Tenure</label>
                                             <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="new_loan_tenure" name="loan_tenure" required="">
                                    <option selected="" value="" disabled>Select Loan tenure</option>
                                   <option value="1">Pay day</option>
                                    <option value="2">2 month</option>
                                    <option value="3">3 month</option>
                                    <option value="4">4 month</option>
                                    <option value="5">5 month</option>
                                    <option value="6">6 month</option>
                                    <option value="7">7 month</option>
                                    <option value="8">8 month</option>
                                    <option value="9">9 month</option>
                                
                                </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="interest-repay">
                                        <div class="form-group bg-white p-1" >

                                            <label class="text-primary" id="n_rate">Rate: 5% </label>
                                            <br>
                                            <label class="text-primary" id="n_interest"> </label>
                                            <br>
                                             <label class="text-primary" id="n_total_repayment"> </label>
                                      
                                        </div>
                                        <!--  <div class="form-group bg-white p-1" >
                                           
                                      
                                        </div> -->
                                    </div>
                                  </div>
                               

                            </fieldset>

                            
                             <fieldset>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-block btn-primary bd-white disabled" disabled=""  value="Submit"  id="w_btn">
                                        </div>
                                    </div>

                                    
                                </div>

                            </fieldset>
                          <?php } ?>
    	</div>
</div>

<
</section>


@endsection














