<!DOCTYPE html>
<html lang="zxx">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="{{ asset('website-assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/meanmenu.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/boxicons.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('website-assets/css/owl.theme.default.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/animate.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/fonts/flaticon.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/odometer.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/nice-select.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/magnific-popup.min.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/style.css')}}">

<link rel="stylesheet" href="{{ asset('website-assets/css/responsive.css')}}">
<title>Daxlinks -  Finance company in nigeria</title>
<link rel="icon" type="image/png" href="{{ asset('website-assets/img/favicon.png')}}">
</head>
<body>

<!-- <div class="loader">
<div class="d-table">
<div class="d-table-cell">
<div class="spinner">
<div class="double-bounce1"></div>
<div class="double-bounce2"></div>
</div>
</div>
</div>
</div> -->


<div class="user-form-area ptb-100">
<div class="container">
       <div class="col-md-6 col-sm-12 col-xs-12 offset-md-3">
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
                </div>
<div class="form-item">
     <img src="{{ asset('website-assets/img/Daxlinks-logo.png')}}" width="220">
                        
     <form method="POST" action="{{ route('password.email') }}">
                        @csrf
<h2>Request Password Reset Link</h2>
<div class="row">
<div class="col-lg-8 offset-lg-2">
<div class="form-group">
 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="*Your Email">
</div>
</div>



<div class="col-lg-8  offset-lg-2">
<button type="submit" class="btn common-btn">
 {{ __('Send Password Reset Link') }}
<span></span>
</button>
</div>
</div>
</form>
<div class="user-btn">
<h3>Didn't have an account?<a href="/">start here</a></h3>
<h3>  <a class="btn btn-link" href="/login">
                                        {{ __('Return to login?') }}
                                    </a>
                             </h3>
<!-- <span>Or Forgot</span> -->

</div>
</div>
</div>
</div>



<div class="copyright-area two">
<div class="container">
<div class="copyright-item">
<p>Copyright @2020 </p>
</div>
</div>
</div>


<div class="go-top">
<i class='bx bxs-up-arrow'></i>
<i class='bx bxs-up-arrow'></i>
</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('website-assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('website-assets/js/popper.min.js')}}"></script>
<script src="{{ asset('website-assets/js/bootstrap.min.js')}}"></script>

<script src="{{ asset('website-assets/js/form-validator.min.js')}}"></script>

<script src="{{ asset('website-assets/js/contact-form-script.js')}}"></script>

<script src="{{ asset('website-assets/js/jquery.ajaxchimp.min.js')}}"></script>

<script src="{{ asset('website-assets/js/jquery.meanmenu.js')}}"></script>

<script src="{{ asset('website-assets/js/owl.carousel.min.js')}}"></script>

<script src="{{ asset('website-assets/js/wow.min.js')}}"></script>

<script src="{{ asset('website-assets/js/odometer.min.js')}}"></script>
<script src="{{ asset('website-assets/js/jquery.appear.min.js')}}"></script>

<script src="{{ asset('website-assets/js/jquery.nice-select.min.js')}}"></script>

<script src="{{ asset('website-assets/js/jquery.magnific-popup.min.js')}}"></script>

<script src="{{ asset('website-assets/js/custom.js')}}"></script>
</body>

</html>