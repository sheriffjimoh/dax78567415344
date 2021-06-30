
@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\MainController; 
@endphp
<!-- users view start -->
<section class="users-view new-print-view">
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
          <!-- session message -->
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
  <?php 
        //     $user_reg = $user->registration;
              foreach ($user as $single) {
              $data =  $single->registration;
 }
 if ($data) {
        ?>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ url('storage/user_profile_pic/'.(($single->profile_pic) ? $single->profile_pic : 'avatar-s-new.png'))}}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>

    
        <div class="media-body pt-25">
            <span
              class="text-muted font-medium-1"> @</span><span
              class="users-view-username text-muted font-medium-1 ">{{$data->firstname.''.$data->lastname}}</span></h4>
              <br>
          <span>Customer ID: {{ $data->user_code}}</span>
          <!-- <span class="users-view-id">305</span> -->
          @if($single->user_status =='new')
      <span class="badge badge-success">New Customer</span>
      @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2 print-no">
    
     <div class="mb-20" style="padding-right: 10px;">
        <a href="#" class="btn btn-sm btn-primary" id="approve-btn">Portfolio</a>
     </div>
     <div  style="padding-right: 10px;">
             <a href="#" class="btn btn-sm btn-warning"  id="disapprove-btn">Rejected</a>
     </div>

      <div>
             <a href="#" class="btn btn-sm btn-info"  id="review-btn">Matured</a>
     </div>

    </div>
  </div>
  <!-- users view media object ends -->
 
  <!-- users view card details start -->
  <div class="card  print-card ">
    <div class="card-content" style="padding:10px;">
      <div class="row text-center">
         <div class="col-sm-4">
           <h4>Portfolio: <i class="badge badge-primary"></i> {{$count_portfolio}} <span class="ft-list  la-lg text-primary"></span></h4>
         </div>
         <div class="col-sm-4">
          <h4>Rejected:<i class="badge badge-warning"></i>  {{$count_rejected}} <span class="la la-close la-lg text-warning"></span></h4>
         </div>
         <div class="col-sm-4">
            <h4>Matured: <i class="badge badge-info"></i>  {{$count_matured}} <span class="ft-layers text-info"></span></h4>
         </div>
      </div>


      <div class="card-body" id="contents">
        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">PersonalDetails</span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>



        <div class="col-12 ">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Firstname:</td>
                <td class="users-view-username">{{$data->firstname}}</td>
              </tr>
              <tr>
                <td>Lastname:</td>
                <td class="users-view-name">{{$data->lastname}}</td>
              </tr>
              <tr>
                <td>E-mail:</td>
                <td class="users-view-email">{{ $data->email}}</td>
              </tr>
              <tr>
                <td>Phone:</td>
                <td>{{$data->phone}}</td>
              </tr>
              


            </tbody>
          </table>
          </div>
          <div class="col-6 ">
                  <table class="table table-borderless">
            <tbody>
           
              
           
              <tr>
                <td style="font-weight: bolder;">Customer's Next of Kin</td>

              </tr>

                 <tr>
                <td>Fullname:</td>
                <td class="users-view-username">{{$data->fullname}}</td>
              </tr>
              <tr>
                <td>Phone:</td>
                <td class="users-view-username">{{$data->kin_phone}}</td>
              </tr>
              
              

            </tbody>
          </table>
          </div>
        </div>

        </div>

         
       

        <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6> -->
          </div>
          <div class="col-12 col-sm-4 p-2">
           <h6 class="text-primary mb-0">Customer's<span class="font-large-1 align-middle">Bank Info </span></h6>
          </div>
          <div class="col-12 col-sm-4 p-2">
            <!-- <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6> -->
          </div>
        </div>


        <div class="col-12">
          <div class="row">
          <div class="col-6">
            
          <table class="table table-borderless">
            <tbody>
              
              <tr>
                <td>Bank-name:</td>
                <td class="users-view-username">{{$data->bank_name}}</td>
              </tr>
               <tr>
                <td>Bank-account-number:</td>
                <td class="users-view-name">{{$data->bank_account_number }}</td>
              </tr>
              <tr>
                <td>Bank-account-type:</td>
                <td class="users-view-name">{{$data->bank_account_type }}</td>
              </tr>

             

            </tbody>
          </table>
          </div>
                
          
        </div>

        </div>
      </div>


         


<!-- forms -->
      <div class="card-body" id="approve-form">
        <hr>

   <h4>
  <strong>{{$data->lastname}}'s  Portfolio  Record</strong>
    </h4>
     <hr>
    <br>
 
           <div class="row">

             <?php if (isset($portfolio)) { foreach ($portfolio as $val) { ?>


            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center md-5">
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
                   <li>Tenure(month) <i class="la la-arrow-right"></i> {{$val->tenure}}</li>
                   <li>Rate <i class="la la-arrow-right"></i> % {{$val->rate}} </li>   
                   <li>Interest Per Month <i class="la la-arrow-right"></i> ₦ {{number_format(ceil($val->monthly_payment),2)}} </li> 
                   <li>Total Interest <i class="la la-arrow-right"></i> ₦ {{number_format(ceil($val->interest),2)}} </li>
                   <li>Started Date <i class="la la-arrow-right"></i> {{$val->start_date}} </li>
                   <li>Matured Date <i class="la la-arrow-right"></i>{{$val->end_date}} </li>

                    </ul>
                  </div>
                </div>
             </div>
    
           <?php } }else{ echo "No Record Found"; }  ?>

         </div>




       </div>
    </div>


       <!-- loan disapprove start -->
           <div class="card-body" id="disapprove-form">
            <hr>  
       <h2>
  <strong>{{$data->lastname}}'s  Rejected Record</strong>
        </h2>
    <hr>
  <div class="row">


           
             <?php if (isset($rejected)) { foreach ($rejected as $val) { ?>


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
                   <li>Amount <i class="la la-arrow-right"></i>  ₦ {{$val->amount}}</li>
                   <li>Tenure(month) <i class="la la-arrow-right"></i> {{$val->tenure}}</li>
                   <li>Rate <i class="la la-arrow-right"></i> % {{$val->rate}} </li>   
                   <li>Interest Per Month <i class="la la-arrow-right"></i> ₦ {{$val->monthly_payment}} </li> 
                   <li>Total - Interest <i class="la la-arrow-right"></i> ₦ {{$val->interest}} </li>
                   <li>Started Date <i class="la la-arrow-right"></i> {{$val->start_date}} </li>
                   <li>Matured Date <i class="la la-arrow-right"></i>{{$val->end_date}} </li>

                    </ul>
                  </div>
                </div>
             </div>
    
           <?php } } ?>

           



          </div>
           </div>

           <!-- forms -->




           <!-- review loan -->
      <div class="card-body" id="review-form">
 <hr>
    <h4>
   <strong>{{$data->lastname}}'s Matured Record</strong>
      </h4>
       <hr>
   <div class="row">


             <?php if (isset($matured)) { foreach ($matured as $val) { ?>


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
                   <li>Amount <i class="la la-arrow-right"></i>  ₦ {{$val->amount}}</li>
                   <li>Tenure(month) <i class="la la-arrow-right"></i> {{$val->tenure}}</li>
                   <li>Rate <i class="la la-arrow-right"></i> % {{$val->rate}} </li>   
                   <li>Interest Per Month <i class="la la-arrow-right"></i> ₦ {{$val->monthly_payment}} </li> 
                   <li>Total - Interest <i class="la la-arrow-right"></i> ₦ {{$val->interest}} </li>
                   <li>Started Date <i class="la la-arrow-right"></i> {{$val->start_date}} </li>
                   <li>Matured Date <i class="la la-arrow-right"></i>{{$val->end_date}} </li>

                    </ul>
                  </div>
                </div>
             </div>
    
        <?php } }else{ echo "No Record Found"; }  ?>
         </div>





       </div>
      </div>
    </div>

  </div>
  <!-- users view card details ends -->

<?php }else{ echo "no record available";} ?>

</section>
<!-- users view ends -->


@endsection