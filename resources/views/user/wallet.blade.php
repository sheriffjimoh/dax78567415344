@extends('layouts.app_header')

@section('content')






     <section id="icon-">    	 <!-- session message -->
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
    <div class="">
        <div class="col-12">
            <div class="card">


        @if (isset($wallet))

      <?php foreach ($wallet as $wallet) {
       }

       if (isset($error)) {
       
         $setwithdraw ='active';
         $balance =null;
       }
   else  {
         $setwithdraw =null;
         $balance ='active';
    
       }
  ?>
             
                 <div class="col-xs-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Wallet balance, Withdraw</h4>
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
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link {{$balance}}" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                  aria-controls="activeIcon1" aria-expanded="true"><i class="la la-money"></i> Wallet Balance</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{$setwithdraw}}" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                  aria-expanded="false"><i class="ft-download"></i> Withdraw</a>
              </li>
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane {{$balance}}" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
                aria-expanded="true">





<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
  

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 offset-md-4 border-right-lighten-5">
              <div class="card-body text-center">
                <div class="card-header mb-2">
                  <span class="success">Available Balance</span>
                  <h3 class="display-4 blue-grey darken-1">₦ {{isset($wallet->balance)? number_format($wallet->balance,2)  :0}}</h3>
                </div>
                <div class="card-content">
                </div>
              </div>
            </div>
      
      
          </div>
        </div>
      </div>
    </div>
  </div>

  
</section>
<!-- // grouped card stats section end -->







              </div>
              <div class="tab-pane {{$setwithdraw}}" id="linkIcon1" role="tabpanel" aria-labelledby="linkIcon1-tab1"
                aria-expanded="false">
                <div class="card-header offset-md-4">
                    <h4 class="card-title">Simply withdraw to your local bank
                     

                      <p>What this means? <a href="#">Learn more </a></p>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    
                </div>


                <div class="card-content offset-md-4 collapse show">
                    <div class="card-body">
                        <form action="/withdraw"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-money"></i>  &nbsp;Amount </h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         
                                            <input type="text" class="form-control" id="w_amount"  name="amount"  autocomplete="off">
                                        </div>
                                        <span class="text-danger" id="error_amount"></span>
                                    </div>
                                </div>
                                   <input type="hidden" name="balance" id="w_balance" value="{{isset($wallet->balance)? $wallet->balance :0}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                         
                                          <label class="text-info">  <i class="step-icon la la-info"></i> &nbsp;The available balance is : ₦ {{isset($wallet->balance)? $wallet->balance :0}}</label>
                                           <p></p>
                                        </div>
                                    </div>

                                    
                                </div>

                            </fieldset>

                              <br>
                            <h6><i class="step-icon la la-bank"></i> Bank  Details</h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                       <label class="text-info">  <i class="step-icon la la-info"></i> &nbsp;
                                        Account Number? dont worry ,  we have got your bank details, if you would like to use different  account for this, you can update your bank information to your new account number , read more <a href="" class="text-primary">here</a> about changing of bank account details 
                                      </label>
<!-- 
                                       <label class="text-warning">  <i class="step-icon la la-warning"></i> &nbsp;
                                       Not , 
                                      </label> -->
                                    </div>
                                </div>

                                
                                 <br>
                            </fieldset>
                               <h6><i class="step-icon la la-lock"></i>Password</h6>
                            <br>
                             <fieldset>

                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                           <!-- <label for="password"><i class="step-icon la la-lock"></i>Password :</label> -->
                                            <input type="password" class="form-control" id="w_password"  name="password" autocomplete="off">
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                       <!-- < > -->
                                        <label class="text-info">
                                        <i class="step-icon la la-info"></i> &nbsp;it is required that you provide your <strong>First time</strong> verification code, this code has been sent to you during the time of registration, through <b>SMS</b> as code and  <b>EMAIL</b> as password please find it,  We are trying to be sure that you are really the one making this operation.</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-block btn-primary"  value="withdraw"  id="w_btn">
                                        </div>
                                    </div>

                                    
                                </div>

                            </fieldset>




                        

                        </form>
                    </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>




       @endif

               
            </div>
        </div>
    </div>
</section>
<!-- Form wizard with icon tabs section end -->


@endsection