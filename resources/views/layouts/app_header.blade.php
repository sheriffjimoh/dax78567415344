<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name', 'Laravel' ) }}  - Admin Area</title>
    <link rel="apple-touch-icon" href="{{ asset('admin-assets/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('website-assets/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
   
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/components.min.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/pages/timeline.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/pages/dashboard-ecommerce.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/pages/dashboard-bank.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/plugins/calendars/clndr.min.css')}}">
    
  <!-- Form wizard -->
   <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/plugins/forms/wizard.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/css/pages/card-statistics.min.css')}}">
 
 
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/new.css')}}">
 
<!-- END: Page CSS-->
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow  print-no">
      <div class="navbar-wrapper" id="content-x">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="/{{Auth::user()->user_type}}"><img class="brand-logo" alt="<?php echo config('app.name');?> logo" src="{{ asset('website-assets/img/favicon.png')}}">
                <h3 class="brand-text"><?php echo config('app.name');?></h3></a></li>

            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content  " >
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
              <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
              
                </ul>
              </li>
                
            </ul>
            <ul class="nav navbar-nav float-right">
           






              <li class="dropdown dropdown-user nav-item">

                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span>

                  @php  $pic  = Auth::user()->profile_pic;
                     if (empty($pic)){
                      $pic  = 'avatar-s-new.png';
                   }

                    @endphp

              <span class="avatar avatar-online"><img src="{{ url('storage/user_profile_pic/'.$pic)}}" alt="avatar"><i></i></span></a>
                <div class="dropdown-menu dropdown-menu-right">


                    <a class="dropdown-item" href="{{ URL::to('/user_profile') }}"><i class="ft-user"></i>Profile</a>

                   
             @if(Auth::user()->user_type =='guess')
                    <a class="dropdown-item" href="{{ URL::to('/myloan_information') }}"><i class="ft-clipboard"></i>Edit information</a>
                @endif
                 @if(Auth::user()->user_type =='investor')
                    <a class="dropdown-item" href="{{ URL::to('/bank_information') }}"><i class="ft-clipboard"></i>Bank information</a>
                @endif
                  @if(Auth::user()->user_type =='admin')

                    <a class="dropdown-item" href="{{ URL::to('/create_admin') }}"><i class="ft-check-square"></i> Create Admin</a>
                    @endif
                  <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form><!-- 
                  <a class="dropdown-item" href="/logout"><i class="ft-power"></i> Logout</a> -->
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
<?php echo $user_type =  Auth::user()->user_type ?>
    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true print-no">
      <div class="main-menu-content print-no">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="{{ URL::to('/'.$user_type) }}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>

           
         </li>

         @if(Auth::user()->user_type =='admin')
         
           <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="la la-bank"></i><span class="menu-title" data-i18n="Dashboard">Naira Wallets</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ URL::to('/loan-wallet') }}"><i></i><span data-i18n="Crypto">Loan</span></a>
              </li>
              <li class=""><a class="menu-item" href="{{ URL::to('/investment-wallet') }}"><i></i><span data-i18n="eCommerce">Investment</span></a>
              </li>
             
            </ul>
          </li>






         <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="la la-money"></i><span class="menu-title" data-i18n="Dashboard">Loans</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ URL::to('/new_customers') }}"><i></i><span data-i18n="Crypto">New Customers</span></a>
              </li>
              <li class=""><a class="menu-item" href="{{ URL::to('/loan-list') }}"><i></i><span data-i18n="eCommerce">All loan</span></a>
              </li>
              <li><a class="menu-item" href="{{ URL::to('/loan-application') }}"><i></i><span data-i18n="Crypto">Loan Applications</span></a>
              </li>
              <li><a class="menu-item" href="{{ URL::to('/loan-disburst') }}"><i></i><span data-i18n="Sales">Loan disbursted</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/loan-review') }}"><i></i><span data-i18n="Sales">Loan Reviewied</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/loan-matured') }}"><i></i><span data-i18n="Sales">Loan Matured</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/loan-reject') }}"><i></i><span data-i18n="Sales">Loan Rejected</span></a>
              </li>
            </ul>
          </li>
            
             <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="icon-cup"></i><span class="menu-title" data-i18n="Dashboard">Investments</span></a>
          <ul class="menu-content">
           
            
              <li><a class="menu-item" href="{{ URL::to('/investment-applications') }}"><i></i><span data-i18n="Crypto">New Applications</span></a>
              </li>
              <li><a class="menu-item" href="{{ URL::to('/investment-porfolio') }}"><i></i><span data-i18n="Sales">Portfolios</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/investment-matured') }}"><i></i><span data-i18n="Sales">Matured</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/investment-rejected') }}"><i></i><span data-i18n="Sales">Rejected</span></a>
              </li>
               <li><a class="menu-item" href="{{ URL::to('/investment-records') }}"><i></i><span data-i18n="Sales">All records</span></a>
              </li>
            </ul>
          </li>
           <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="Dashboard">Customers</span></a>
          <ul class="menu-content">
              <li class=""><a class="menu-item" href="{{ URL::to('/all_customer') }}"><i></i><span data-i18n="eCommerce">Borrowers</span></a>
              </li>
              <li><a class="menu-item" href="{{ URL::to('/investment_customers') }}"><i></i><span data-i18n="Crypto">Investors</span></a>
              </li>
             
            </ul>
          </li>
           <li class=" nav-item"><a href="{{ URL::to('/transaction_logs') }}"><i class="la la-bank"></i><span class="menu-title" data-i18n="transaction">Transaction Logs</span></a>
         </li>

            <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="icon-equalizer"></i><span class="menu-title" data-i18n="Dashboard">Comfirm Repayments</span></a>
          <ul class="menu-content">
              <li class=""><a class="menu-item" href="{{ URL::to('/repay_day') }}"><i></i><span data-i18n="eCommerce">
                <?php echo date("Y-m-d")?> &nbsp;Repayments
              </span></a>
              </li>
              <li><a class="menu-item" href="{{ URL::to('/overdue') }}"><i></i><span data-i18n="Crypto">Overdue Repayment</span></a>
              </li>
             
            </ul>
          </li>

             <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="icon-user"></i><span class="menu-title" data-i18n="Dashboard">Manage Accounts</span></a>
          <ul class="menu-content">
              <li class=""><a class="menu-item" href="{{ URL::to('/manage_account') }}"><i></i><span data-i18n="eCommerce">
              Customers 
              </span></a>
              </li>
             <!--  <li><a class="menu-item" href="/overdue"><i></i><span data-i18n="Crypto">Overdue Repayment</span></a>
              </li> -->
             
            </ul>
          </li>

          @endif





             @if(Auth::user()->user_type =='guess')
               
        <li class=" nav-item"><a href="{{ URL::to('/mywallet') }}"><i class="la la-bank"></i><span class="menu-title" data-i18n="Dashboard">Wallet</span></a>
         </li>
         <li class="dropdown nav-item" data-menu="dropdown"><a href="#"><i class="la la-money"></i><span class="menu-title" data-i18n="Dashboard">Loan</span></a>
          <ul class="menu-content">
              <li class=""><a class="menu-item" href="{{ URL::to('/user_loans') }}"><i></i><span>Loans</span></a>
              </li>
               <li class=""><a class="menu-item" href="{{ URL::to('/user_loans_review') }}"><i></i><span>Loan Review</span></a>
              </li>
               <li class=""><a class="menu-item" href="{{ URL::to('/user_loans_rejected') }}"><i></i><span>Loan Rejected</span></a>
              </li>
              <li class=""><a class="menu-item" href="{{ URL::to('/user_loans_repayments') }}"><i></i><span>Loan Repayments</span></a>
              </li>

              
             <!--  <li><a class="menu-item" href="#"><i></i><span data-i18n="Sales">Loan disbursment</span></a>
              </li> -->
            </ul>
          </li>
           <li class=" nav-item"><a href="{{ URL::to('/documents') }}"><i class="la la-files-o"></i><span class="menu-title" data-i18n="Dashboard">Documents</span></a>
           <li class=" nav-item"><a href="{{ URL::to('/user_transaction_logs') }}"><i class="la la-folder-o"></i><span class="menu-title" data-i18n="Dashboard">Transaction Log</span></a>
           <li class=" nav-item"><a href="{{ URL::to('/user_manual_repayments') }}"><i class="la la-money"></i><span class="menu-title" data-i18n="Dashboard">Repay loan(manually)</span></a>
           
         </li>
          <li class=" nav-item"><a href="{{ URL::to('/new_loan_application') }}" class="btn btn-primary" style="color:#fff; font-weight: bolder;"><span class="menu-title" data-i18n="Dashboard">Create Loan </span></a>
          </li>
        
             @endif

          @if(Auth::user()->user_type =='investor')
           <li class=" nav-item"><a href="{{ URL::to('/wallet') }}"><i class="la la-bank"></i><span class="menu-title" data-i18n="Wallet">Wallet</span></a>
         </li>
          <li class=" nav-item"><a href="{{ URL::to('/portfolios') }}"><i class="ft-list"></i><span class="menu-title" data-i18n="Dashboard">Portfolios</span></a>
          </li>
         <li class=" nav-item"><a href="{{ URL::to('/matured') }}"><i class="ft-layers"></i><span class="menu-title" data-i18n="Dashboard">Matureds</span></a>
          </li>
           <li class=" nav-item"><a href="{{ URL::to('/rejected') }}"><i class="ft-x"></i><span class="menu-title" data-i18n="Dashboard">Rejected Applications</span></a>
          </li>
              <li class=" nav-item"><a href="{{ URL::to('/transactions') }}"><i class="la la-folder-o"></i><span class="menu-title" data-i18n="Dashboard">Transaction Logs</span></a>
          <li class=" nav-item"><a href="{{ URL::to('/new_investment_application') }}" class="btn btn-primary" style="color:#fff; font-weight: bolder;"><span class="menu-title" data-i18n="Dashboard">Create Investment</span></a>
          </li>
          @endif

         
        </ul>
      </div>
    </div>

    <!-- END: Main Menu-->
       <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>

        @yield('content')

      </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2020 <a class="text-bold-800 grey darken-2" href="#" target="_blank">Tomxcredit</a></span>
   </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin-assets/app-assets/vendors/js/charts/chartist.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/charts/morris.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/timeline/horizontal-timeline.js')}}"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin-assets/app-assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/core/app.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/scripts/customizer.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/scripts/footer.min.js')}}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('admin-assets/app-assets/js/scripts/tables/datatables/datatables.min.js')}}"></script>"></script>
  
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin-assets/app-assets/js/scripts/pages/dashboard-ecommerce.min.js')}}"></script>

    <script src="{{ asset('admin-assets/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/js/scripts/pages/dashboard-bank.min.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('admin-assets/datatables/jquery.dataTables.min.js')}}"></script>


    <!-- BEGIN: Page Vendor JS-->
     <script src="{{ asset('admin-assets/app-assets/vendors/js/extensions/clndr.min.js')}}"></script>

     <script src="{{ asset('admin-assets/app-assets/chart.js/Chart.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{ asset('admin-assets/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
    <script src="{{ asset('admin-assets/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
 
    <script src="{{ asset('admin-assets/app-assets/vendors/js/forms/wizard-steps.min.js')}}"></script>

    <script src="{{ asset('admin-assets/app-assets/js/scripts/cards/card-statistics.min.js')}}"></script>

    <!-- END: Theme JS-->
        <script src="{{ asset('admin-assets/assets/js/scripts.js')}}"></script>


<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months ?? '' ?>,
    datasets: [
      {
        label               : 'Disburstment',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $disburstment ?? ''; ?>
      },
      {
        label               : 'Repayment',
        fillColor           : 'red',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $repayment ?? ''; ?>
      } ,
       {
        label               : 'withdraw',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $withdraw ?? ''; ?>
      } 
    ]
  }
  barChartData.datasets[1].fillColor   = '#022b69'
  barChartData.datasets[1].strokeColor = '#022b69'
  barChartData.datasets[1].pointColor  = '#022b69'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"> <% for (var i=0; i<datasets.length; i++){%> <li><span style="background-color:<%=datasets[i].fillColor%>"><%= datasets[i].data %></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>




<!-- loan Customer Chart -->


  <script>

    var polarData = [
        {
          value: <?php echo $repayment_chart ?? 0; ?>,
          color:"#FDB45C",
          highlight: "#eeee",
          label: "Repayment"
        },
        {
          value: <?php echo $disburstment_chart ?? 0; ?>,
          color: "#022b69",
          highlight: "#5AD3D1",
          label: "Disburstment"
        },
        {
          value:<?php echo $withdraw_chart ?? 0; ?>,
          color: "#F7464A",
          highlight: "#eeee",
          label: "withdraw"
        }

      ];

      window.onload = function(){
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPolarArea = new Chart(ctx).PolarArea(polarData, {
          responsive:true
        });
      };




  </script>



<!-- Investment Admin -->

 


<!-- investors -->
<?php  if (Auth::user()->user_type == 'investor') {?>

  <script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
      labels : <?php echo $months ?? '' ?>,
      datasets : [
        {
          label: "Investment",
          fillColor : "#9B8A87",
          strokeColor : "#9B8A87",
          pointColor : "#9B8A87",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "#9B8A87",
          data : <?php echo $investment ?? 0; ?>
        },
        {
          label: "Interest",
          fillColor : "#022b69",
          strokeColor : "#022b69",
          pointColor : "#022b69",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "#022b69",
          data : <?php echo $interest ?? 0; ?>
        }
      ]

    }

  window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true
    });
  }


  </script>

<?php } ?>

  <script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = '/guess/'+$(this).val();
  });
});
</script>

 <script>
$(function(){
  $('#select_year_a').change(function(){
    window.location.href = '/admin/'+$(this).val();
  });
});
</script>








<?php  if (Auth::user()->user_type =='admin') {?>


    <script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
      labels : <?php echo $months ?? '' ?>,
      datasets : [
        {
          label: "Investment",
          fillColor : "#9B8A87",
          strokeColor : "#9B8A87",
          pointColor : "#9B8A87",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "#9B8A87",
          data : <?php echo $investment ?? 0; ?>
        },
        {
          label: "Interest",
          fillColor : "#022b69",
          strokeColor : "#022b69",
          pointColor : "#022b69",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "#022b69",
          data : <?php echo $interest ?? 0; ?>
        }
      ]

    }

  window.onload = function(){
    var ctx = document.getElementById("next-c").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true
    });
  }


  </script>


<?php } ?>
  </body>
  <!-- END: Body-->