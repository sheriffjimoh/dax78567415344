<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS --> 
        <link rel="stylesheet" href="{{ asset('website-assets/css/bootstrap.min.css') }}">
        <!-- Animate CSS --> 
        <link rel="stylesheet" href="{{ asset('website-assets/css/animate.css') }}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/meanmenu.css') }}">
        <!-- Boxicons CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/boxicons.min.css') }}">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/flaticon.css') }}">
        <!-- Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/owl.carousel.min.css') }}">
        <!-- Carousel Default CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/owl.theme.default.min.css') }}">
        <!-- Carousel Default CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/owl.theme.default.min.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/nice-select.css') }}">
        <!-- Odometer CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/odometer.css') }}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('website-assets/css/responsive.css') }}">
        
        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <link rel="icon" type="image/png" href="{{ asset('website-assets/img/favicon.png') }}">
    </head>
    <body>
        
   

        <!-- End Page Title Area -->
    
          

        <!-- Start Sign In Area -->
        <div class="sign-in-area ptb-100">
            <div class="container">
                <div class="sign-in-form">
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
        <!-- Start Copy Right Area -->
        <div class="copy-right-area">
            <div class="container">
                <div class="copy-right-content">
                     <p>
                        Copyright @2020 {{ config('app.name', 'Laravel') }}
                   </p>
                </div>
            </div>
        </div>
        <!-- End Copy Right Area -->

 
        <!-- Jquery Slim JS -->
        <script src="{{ asset('website-assets/js/jquery.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ asset('website-assets/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('website-assets/js/bootstrap.min.js') }}"></script>
        <!-- Meanmenu JS -->
        <script src="{{ asset('website-assets/js/jquery.meanmenu.js') }}"></script>
        <!-- Carousel JS -->
        <script src="{{ asset('website-assets/js/owl.carousel.min.js') }}"></script>
        <!-- Nice Select JS -->
        <script src="{{ asset('website-assets/js/jquery.nice-select.min.js') }}"></script>
        <!-- Magnific Popup JS -->
        <script src="{{ asset('website-assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Odometer JS -->
        <script src="{{ asset('website-assets/js/odometer.min.js') }}"></script>
        <!-- Appear JS -->
        <script src="{{ asset('website-assets/js/jquery.appear.js') }}"></script>
        <!-- Form Ajaxchimp JS -->
        <script src="{{ asset('website-assets/js/jquery.ajaxchimp.min.js') }}"></script>
        <!-- Form Validator JS -->
        <script src="{{ asset('website-assets/js/form-validator.min.js') }}"></script>
        <!-- Contact JS -->
        <script src="{{ asset('website-assets/js/contact-form-script.js') }}"></script>
        <!-- Wow JS -->
        <script src="{{ asset('website-assets/js/wow.min.js') }}"></script>
        <!-- Custom JS -->
        <script src="{{ asset('website-assets/js/main.js') }}"></script>
    </body>

</html>