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
    
    <title>{{ config('app.name', 'Laravel') }} - Loans and Funding Agency In Nigeria</title>

        <link rel="icon" type="image/png" href="{{ asset('website-assets/img/favicon.png') }}">
    </head>

    <body>


 
        <!-- Start Error Area -->
    <section class="error-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="error-content">
                            <img src="{{ asset('website-assets/img/404.png')}}" alt="error">
        
                            <h3>Page Not Found</h3>
                            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
        
                            <a href="/" class="default-btn">
                                Go to Home
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

  <script src="{{asset('reg-assets/js/jquery.min.js')}}"></script>
   <script src="{{asset('reg-assets/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="{{asset('reg-assets/js/scripts.js')}}"></script>
    <script src="{{asset('reg-assets/js/main.js')}}"></script>
</body>
</html>