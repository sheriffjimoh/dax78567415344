@extends('layouts.app_header')

@section('content')

@php 
use App\Http\Controllers\MainController; 
@endphp





         <section id="icon-tabs">    	 <!-- session message -->
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
    <div class="row">
        <div class="col-12">
            <div class="card">


<!-- grouped card stats section start -->
<section id="grouped-stats" class="grouped-stats">
   
     <div class="card">
       <div class="card-header">
        <h3>Information , Update Information</h3>
       </div>
         <div class="card-content">
          <div class="card-body">
           <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal"
                  aria-controls="personal" aria-expanded="true"><i class="la la-user"></i> &nbsp;Account Information</a>
              </li>
               <li class="nav-item">
                <a class="nav-link " id="employer-tab" data-toggle="tab" href="#employer"
                  aria-controls="employer" aria-expanded="true"><i class="la la-credit-card"></i> &nbsp;Update Information</a>
              </li>
              
             
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="personal"
                aria-expanded="true">

                 <div class="text-center offset-3 col-md-6">
                  <a  data-toggle="modal" data-target="#exampleModal" title="Update this image">
 
                   <img src="{{ url('storage/user_profile_pic/'.(($info->profile_pic) ? $info->profile_pic :'avatar-s-new.png'))}}" class="img img-responsive img-thumbnail" width="120px"></a>
                   <ul class="list-group">
                     <li class="list-group-item"><span class="pull-left">Username:</span>  <span class="pull-right">{{$info->name}}</span> </li>
                      <li class="list-group-item"><span class="pull-left">Email:</span>  <span class="pull-right">{{$info->email}}</span> </li>
                   </ul>
                 </div>




               </div>
               <div role="tabpanel" class="tab-pane " id="employer" aria-labelledby="employer-tab"
                aria-expanded="true">
                
         
                  <div class="card-content  collapse show">
                    <div class="card-body">
                        <form action="update_user_profile"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-user"></i> Account Information</h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" id="username"  name="username"  autocomplete="off" value="{{$info->name}}">
                                        </div>
                                        <span class="text-danger" id="error_username"></span>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email"  name="email"  autocomplete="off" value="{{$info->email}}">
                                        </div>
                                        <span class="text-danger" id="error_email"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="password"  name="password"  autocomplete="off">
                                        </div>
                                        <span class="text-danger" id="error_password"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Repeat Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                              name="password_confirmation"  autocomplete="off"  >
                                        </div>
                                        <span class="text-danger" id="error_password_confirmation"></span>
                                    </div>
                                 
                                    
                                  
                                </div>

                                </div>
                               

                            </fieldset>

                            
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                           <input type="submit" class="btn btn-block btn-primary"  value="Update"  id="w_btn">
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

                    <!-- Invoices List table -->
</section>

</div></div></div>
<!-- Form wizard with icon tabs section end -->







<!-- update logo -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile Pic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="updateprofile_pic" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group text-center">
          <label class="btn btn-primary">
            Choose Image
           <input type="file" name="profile_pic" class="form-control" id="profile-pic">
         </label>
        </div>
        <span id="display-profile-pic"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save change</button>
      </div>
    </form>
    </div>
  </div>
</div>


@endsection