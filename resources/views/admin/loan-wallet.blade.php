@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\MainController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card" id="walletcontent">

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





                <div class="card-header">
                    <h4 class="card-title float-left">  Wallet Logs </h4>
                    <div class="text-center">
                        @if(isset($sum_wallets) && !empty($sum_wallets))
                        @foreach($sum_wallets as $data )

                         @endforeach
                          @if(!empty($data))
                        <h3 ><strong>Total amount Available: <span class="text-primary">{{'₦'. number_format($data->balance,2)  }}</span></strong></h3>
                        @endif
                      
                      @endif
                    </div>
                    <div class="float-right">
                        <a class="btn btn-sm btn-primary box-shadow-2 round btn-min-width pull-right white" id="addfund"  href="#">
                            <i class="ft-plus white"></i>Fund Wallet
                        </a>
                    </div>
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0" >Added by</th>
                                    <th class="border-top-0">Date Added</th>
                                    <th class="border-top-0">Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                              
                               @if(isset( $wallets))

                               <?php $srn = 0; ?>
                               @foreach($wallets as $data )
                              <tr>
                                <?php $srn++; ?>
                                <td>{{$srn}}</td>
                                   <td>
                                       {{'₦'.number_format($data ->amount,2) }}
                                   </td> 

                                   <td>
                                     <?php 
                                  echo  MainController::AdminName($data ->user_id);
                                     ?>
                                   </td>
                                  
                                    
                                    <td>
                                       {{$data ->created_at}}
                                   </td>
                                   <td>
                                       <a href="/deletewallet/{{$data ->id}}" onclick="return confirm('are you sure you want to delete? ')"  class="btn btn-danger"><i class="la la-trash"></i></a>
                                   </td>
                              </tr>

                               @endforeach
                              
                                
                               @endif
                              
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>













              

























<!-- add fund -->
            <div class="card" id="addfundform">

                 <div class="card-header">
                    <h4 class="card-title float-left">  Add fund to the wallet </h4>
                    <div class="float-right">
                        <!-- <a class="btn btn-sm btn-primary box-shadow-2 round btn-min-width pull-right white" href="#">
                            <i class="ft-plus white"></i>Fund Wallet
                        </a> -->
                    </div>
                </div>
                <div class="col-5   offset-lg-3">
                 <form  action="/addfund" method="post">
                            <div class="row"  >
                                <input type="hidden"  name="user_id" value="{{Auth::user()->id}}">
                                          
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label> Amount</label>
                                            <input type="text" class="form-control" required="" name="amount">
                                        </div>
                                    </div>
                                      
                                                       
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Add fund</button>
                                    <a id="cancel" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    
                </div>
                  
            </div>
        </div>
    </div>
</section>


@endsection
