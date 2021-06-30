@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\MainController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card">
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
                    <h4 class="card-title float-left">

                       
                  Manage  Custmers  Account
                    </h4>
                    <div class="float-right">
                      <!--   <a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right white" href="bank-add-loan.html">
                            <i class="ft-plus white"></i>Add New Loan
                        </a> -->
                    </div>
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table   id="example1" class="table alt-pagination  loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Customer Code</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Account Name</th>
                                    <!-- <th class="border-top-0">Customer Password</th> -->
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Phone </th>
                                    <th class="border-top-0">Account Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($data)) {
                                $srn =0;

                                foreach ($data as  $value) {
                                 
                                $srn ++;
                           ?>
                                      <tr>
                                        <td>
                                          {{$srn}}
                                        </td>
                                         <td>
                                          {{$value->user_code}}
                                        </td>
                                        <td>
                                         
                                          {{  $value->firstname .' '. $value->lastname}}
                                        
                                        </td>
                                        <td>
                                         
                                          {{  $value->name}}
                                        
                                        </td>
                                        <!-- <td>
                                          {{$value->password}}
                                        </td> -->
                                        <td>
                                          {{$value->email}}
                                        </td>
                                        <td>
                                          {{$value->phone}}
                                        </td>
                                          
                                             <td>
                                          @if($value->account_status =='on')
                                           <span class="badge badge-success">Active</span>
                                           @else

                                           <span class="badge badge-warning">Deactivated</span>
                                          @endif
                                         
                                          
                                        </td>

                                       <td>
                          <span class="dropdown">
                                <button id="btnSearchDrop28" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop28" class="dropdown-menu mt-1 dropdown-menu-right">
                                         @if($value->account_status =='on')
                                          
                                            <a href="/activate_customer/{{$value->id}}" class="dropdown-item" onclick="return confirm('You are trying to  deactivate this user account?')" ><i class="la la-cog danger"></i> Deactivate</a>
                                          @else

                                            <a href="/activate_customer/{{$value->id}}" class="dropdown-item" onclick="return confirm('You  are trying to  activate this user account?')" ><i class="la la-cog success"></i> Activate</a>
                                          @endif
                                </span>
                            </span>
                        </td>  
                                </tr>

                               <?php  }  } ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
