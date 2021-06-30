<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="content ">

       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     <title>{{ config('app.name', 'Laravel') }} - Registration </title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('website-assets/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!--  style -->
  <link rel="stylesheet" type="text/css" href="{{ asset ('reg-assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('reg-assets/css/style.css')}}  ">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <!-- As a heading -->
    <nav class="navbar navbar-light ">
      <span class="navbar-brand mb-0 h1">
        <a href="/"> <img src="{{ asset('website-assets/img/Daxlinks-logo.png')}}"></a></span>
    </nav>



    <div class="main-mix">
      <div class="mix-list " >
        <div class="col-lg-12 col-sm-12 col-md-12 content-invest">
        <div class="row">
           <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 n-colum-t">
            <div class="invest-text">
              
              <h3>Start Invest with Your Savings </h3>
              <p>Grow more than you emerging</p> 
            </div>
           </div>
            <div class="col-lg-2 col-md-2  col-xs-12 n-colum">
              <div class="invest-img">
                     <img src="{{ asset ('website-assets/img/works-main.png')}}" class="img img-responsive" >
      
              </div>
           </div>
         </div>
      </div>
    </div>
  </div>



               <div class="container-fluid">
                 <form class="form-horizontal" action="{{ route('registrations.store') }}" id="invest-form" enctype=" multipart/form-data">
                   
                 <div class="col-lg-10 offset-lg-1 section-invest-input-group">
                  <div class="row">
                   <div class="col-lg-3">
                    <header>

                    <h3> <span class="color-b-line">Start</span> From Here</h3> 
                    <br>
                     <h6 class="login-text"><span>Already have an account ? <a href="/login" class="text-primary">Login</a></span></h6>
                  </header>
                  </div>
                    <div class="col-lg-8">
                <div class="msg" id="msg">
                  
                </div>

                   <div class="row">
                       <div  class="col-lg-6" id="invest-firstname">
                        <div class="input-group mb-1 input-n err-line-firstname">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Firstname"  id="in-firstname">

                        </div> 
                        <div class="error-msg">
                           <span id='firstname-error'></span>
                        </div>
                      </div>
                      <div  class="col-lg-6" id="invest-lastname">
                        <div class="input-group mb-1 input-n err-line-lastname">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Lastname"  id="in-lastname">

                        </div> 
                        <div class="error-msg">
                           <span id='lastname-error'></span>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                       <div  class="col-lg-6" id="invest-email">
                        <div class="input-group mb-1 input-n err-line-email">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                          </div>
                          <input type="email" class="form-control" placeholder="Email"  id="in-email">

                        </div> 
                        <div class="error-msg">
                           <span id='email-error'></span>
                        </div>
                      </div>
                      <div  class="col-lg-6" id="invest-phone">
                        <div class="input-group mb-1 input-n err-line-phone">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Phone"  id="in-phone">

                        </div> 
                        <div class="error-msg">
                           <span id='phone-error'></span>
                        </div>
                      </div>
                    </div>

                      <div class="row">
                       <div  class="col-lg-6" id="invest-address">
                        <div class="input-group mb-1 input-n err-line-address">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Address"  id="in-address">

                        </div> 
                        <div class="error-msg">
                           <span id='address-error'></span>
                        </div>
                      </div>
                      <div  class="col-lg-6" id="invest-occupation">
                        <div class="input-group mb-1 input-n bvn-n">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-briefcase"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Occupation"  id="in-occupation">

                        </div> 
                        <div class="error-msg">
                           <span id='occupation-error'></span>
                        </div>
                      </div>
                    </div>


                      <div class="row">
                       <div  class="col-lg-6" id="__monthly_income">
                        <div class="input-group mb-1 input-n err-line-monthly-income">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa  fa-hand-rock-o "></i></span>
                          </div>
                            <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="monthly_income">
                            <option selected='' value=" " disabled>Average Monthly Income</option>
                             <option value="0-100k">0-100k</option>
                            <option value="101k to 500k"> 101k to 500k</option>
                            <option value="501k - 1m">501k - 1m</option>
                            <option value="1m to 5m">1m to 5m</option>
                            <option value="Above 5m">Above 5m</option>
                         
                         </select>
                        </div> 
                        <div class="error-msg">
                           <span id='monthly-income-error'></span>
                        </div>
                      </div>
                      
                    </div>

                    <h3>Next of kin</h3>

                     <div class="row">
                       <div  class="col-lg-6" id="invest-address">
                        <div class="input-group mb-1 input-n err-line-fullname">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Fullname"  id="in-fullname">

                        </div> 
                        <div class="error-msg">
                           <span id='fullname-error'></span>
                        </div>
                      </div>
                      <div  class="col-lg-6" id="invest-kin-email">
                        <div class="input-group mb-1 input-n err-line-kin-email">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-email"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Email"  id="kin-email">

                        </div> 
                        <div class="error-msg">
                           <span id='kin-email-error'></span>
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      
                      <div  class="col-lg-6" id="invest-kin-phone">
                        <div class="input-group mb-1 input-n err-line-kin-phone">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Phone"  id="kin-phone">

                        </div> 
                        <div class="error-msg">
                           <span id='kin-phone-error'></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                       <div class="spinner-border text-primary text-center" role="status" id="spin" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#" id="btn-invest" class="btn btn-fefault btn-submit ">
                      Submit</a> 
                      </div>
                       
                    </div>



                
                       
                        

                      
                      </div>
                       </div>
                     </div>
                    </form>

                    <div class="col-lg-10 offset-lg-1 success-content" id="s-content" >
                      <img src="{{ asset('website-assets/img/success-save-png.jpg')}}" class="img img-responsive">
                      <h3>You have successfully signed up,A verification link has been sent to this email
                      <span class="text-primary" id="email-text"></span>, check it out !</h3>
                      
                    </div>
               </div>

  <script src="{{asset('reg-assets/js/jquery.min.js')}}"></script>
   <script src="{{asset('reg-assets/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="{{asset('reg-assets/js/scripts.js')}}"></script>
    <script src="{{asset('reg-assets/js/main.js')}}"></script>
</body>
</html>