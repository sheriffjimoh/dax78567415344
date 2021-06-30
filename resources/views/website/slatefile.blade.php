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
        
        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <div class="main-responsive-nav">
                <div class="container">
                    <div class="main-responsive-menu">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('website-assets/img/logo.png') }}" alt="image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-navbar">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('website-assets/img/logo.png') }}" alt="image">
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                              <ul class="navbar-nav">


                                <li class="nav-item">
                                    <a href="/" class="nav-link ">
                                        Home 
                                    
                                    </a></li>
                                  <li class="nav-item">
                                           <a href="/about" class="nav-link active">
                                                About
                                            </a>
                                        </li>
                                        

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                       Explore Pages 
                                        <i class='bx bx-chevron-down'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                      
                                        <li class="nav-item">
                                            <a href="team.html" class="nav-link">
                                                Team
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/faq" class="nav-link">
                                                FAQ
                                            </a>
                                        </li>

                                      
                                        </li>
                                    
                                       

                                      

                                        <li class="nav-item">
                                            <a href="/terms-condition" class="nav-link">
                                                Terms & Conditions
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="privacy-policy.html" class="nav-link">
                                                Privacy Policy
                                            </a>
                                        </li>
                                    

                                    </ul>
                                </li>
                                 <li class="nav-item">
                                            <a href="{{ URL::to('/login')}}" target="_"  class="nav-link">
                                                Login
                                            </a>
                                        </li>
       
                                <li class="nav-item">
                                    <a href="/contact" class="nav-link">
                                        Contact
                                    </a>
                                </li>
                            </ul>

                            <div class="others-options d-flex align-items-center">
                             <!--    <div class="option-item">
                                    <i class="search-btn flaticon-magnifying-glass"></i>
                                    <i class="close-btn flaticon-close"></i>
                                    <div class="search-overlay search-popup">
                                        <div class='search-box'>
                                            <form class="search-form">
                                                <input class="search-input" name="search" placeholder="Search" type="text">

                                                <button class="search-button" type="submit">
                                                    <i class="flaticon-magnifying-glass"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
 -->
                                <div class="option-item">
                                    <div class="info">
                                        <i class="flaticon-telephone"></i>
                                        <span>Call Now</span>
                                        <p>
                                            <a href="tel:1514312-5678">+234 701-103-7821</a>
                                        </p>
                                    </div>
                                </div>

                               <!--  <div class="option-item">
                                    <a href="/registrations" class="default-btn">
                                        Apply now
                                        <span></span>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->


         <!-- Start Loan Area -->
        <section class="loan-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="loan-image">
                            <img src="{{ asset('website-assets/img/loan.png')}}" alt="image">

                            <div class="loan-shape">
                                <div class="text">
                                    <img src="{{ asset('website-assets/img/logo2.png')}}" alt="image" width="140">
                                    <span>We believe in those made to do more</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="loan-content">
                            <h3>How to invest with us?</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Quis ipsum suspendisse ultrices gravida</p>

                            <ul class="list">
                                <li>Unsecured loans of between #500 - #1,000,000</li>
                                <li>Borrow over 1-5 years at a fixed interest rate of 6%</li>
                                <li>FREE mentoring for the first year of the loan</li>
                                <li>No minimum trading requirement.</li>
                            </ul>
                            <h4>Resources to help you with your Loan</h4>
                            <ul class="loan-list">
                                <li>
                                    <i class="flaticon-check"></i>
                                    Business Plan
                                </li>
                                <li>
                                    <i class="flaticon-check"></i>
                                    Budget Planner
                                </li>
                                <li>
                                    <i class="flaticon-check"></i>
                                    Cashflow Forecast
                                </li>
                            </ul>
                            <div class="loan-btn">
                                @if(Auth::user() && Auth::user()->user_type =='investor')
                                <a href="/authorized" class="default-btn">
                                  Dashboard
                                    <span></span>
                                </a>
                                @else
                                <a href="/investment" class="default-btn">
                                   Apply Now
                                    <span></span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Loan Area -->


        <!-- Start Overview Area -->
        <section class="overview-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span>What’s the process?</span>
                    <h2>The Loans have helped us move our business forward</h2>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="overview-item">
                            <div class="number">
                                <span>Apply</span>
                                <strong>1</strong>
                            </div>
                            <h3>Easily apply in <br> minutes</h3>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="overview-item">
                            <div class="number">
                                <span>Process</span>
                                <strong>2</strong>
                            </div>
                            <h3>Clear and transparent <br> process</h3>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="overview-item">
                            <div class="number">
                                <span>Support</span>
                                <strong>3</strong>
                            </div>
                            <h3>Support from real <br> people</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overview-shape">
                <div class="shape">
                    <img src="{{ asset('website-assets/img/works-shape.png')}}" alt="image">
                </div>
                <div class="shape2">
                    <img src="{{ asset('website-assets/img/works-shape2.png')}}" alt="image">
                </div>
            </div>
        </section>
        <!-- End Overview Area -->


        <!-- Start Deserve Area -->
        <section class="deserve-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="deserve-item">
                            <h3>How do I apply for a loan</h3>

                            <div class="deserve-content">
                                <span>1</span>
                                <h4>Apply in 10 minutes</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>

                            <div class="deserve-content">
                                <span>2</span>
                                <h4>Hear from us in 1 hour</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>

                            <div class="deserve-content">
                                <span>3</span>
                                <h4>A decision in 24 hours</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>

                            <div class="deserve-content">
                                <span>4</span>
                                <h4>Your loan is funded</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>

                            <div class="deserve-btn">
                                 @if(Auth::user() && Auth::user()->user_type =='guess')
                                <a href="/authorized" class="default-btn">
                                  Dashboard
                                    <span></span>
                                </a>
                                @else
                                <a href="/registrations" class="default-btn">
                                    Apply Now
                                    <span></span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="default-image">
                            <img src="{{ asset('website-assets/img/loan2.png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Deserve Area -->
        <!-- Start Footer Area -->
        <section class="footer-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <div class="logo">
                                <a href="#">
                                    <img src="{{ asset('website-assets/img/logo2.png') }}" alt="image">
                                </a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consec tetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <ul class="social">
                                <li>
                                    <b>Follow us:</b>
                                </li>
                                
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="flaticon-twitter"></i>
                                    </a>
                                </li>
            
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="flaticon-instagram"></i>
                                    </a>
                                </li>
            
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="flaticon-facebook"></i>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="flaticon-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Quick Links</h3>

                            <ul class="quick-links">
                                <li>
                                    <a href="about.html">About</a>
                                </li>
                                <li>
                                    <a href="#">Our Performance</a>
                                </li>
                                <li>
                                    <a href="faq.html">Help (FAQ)</a>
                                </li>
                                <li>
                                    <a href="news.html">Blog</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>    
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Other Resources</h3>

                            <ul class="quick-links">
                                <li>
                                    <a href="#">Support</a>
                                </li>
                                <li>
                                    <a href="privacy-policy.html">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="terms-condition.html">Terms of Service</a>
                                </li>
                                <li>
                                    <a href="#">Business Loans</a>
                                </li>
                                <li>
                                    <a href="#">Loan Services</a>
                                </li>
                            </ul>
                        </div>    
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Contact Us</h3>

                            <div class="info-contact">
                                <i class="flaticon-pin"></i>
                                <span>Ibadan,Oyo, Nigeria</span>
                            </div>

                            <div class="info-contact">
                                <i class="flaticon-mail"></i>
                                <span>
                                    <a href="mailto:hello@tomxcredit.com">hello@tomxcredit.com</a>
                                </span>
                               <!--  <span>
                                    <a href="#">Skype: example</a>
                                </span> -->
                            </div>

                            <div class="info-contact">
                                <i class="flaticon-telephone"></i>
                                <span>
                                    <a href="tel:+2347011037821">+234 701-103-7821</a>
                                </span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Footer Area -->

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

        <!-- Start Go Top Area -->
        <div class="go-top">
            <i class='bx bx-chevron-up'></i>
        </div>
        <!-- End Go Top Area -->

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