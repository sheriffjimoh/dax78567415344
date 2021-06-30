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
        <h3>Create Account , Account Records</h3>
       </div>
         <div class="card-content">
          <div class="card-body">
           <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal"
                  aria-controls="personal" aria-expanded="true"><i class="la la-user"></i> &nbsp;Create Account</a>
              </li>
               <li class="nav-item">
                <a class="nav-link " id="employer-tab" data-toggle="tab" href="#employer"
                  aria-controls="employer" aria-expanded="true"><i class="la la-credit-card"></i> &nbsp;Manage</a>
              </li>
              
             
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="personal"
                aria-expanded="true">
                    <div class="card-body">

                               <h6><i class="step-icon la la-user"></i> Create Account</h6>
                            <br>
                 <div class="col-md-6 offset-3">
                        <form action="create_new_admin"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                            <fieldset>
                                <div class="">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" id="username"  name="username"  autocomplete="off" >
                                        </div>
                                        <span class="text-danger" id="error_username"></span>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email"  name="email"  autocomplete="off" >
                                        </div>
                                        <span class="text-danger" id="error_email"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Permission</label>
                                            <select class="form-control" name="permission">
                                              <option value=" " selected=" ">Select--</option>
                                              <option value="administrator">Administrator</option>
                                              <option value="moderator">Moderator</option>
                                            </select>
                                        </div>
                                        <span class="text-danger" id="error_email"></span>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="password"  name="password"  autocomplete="off">
                                        </div>
                                        <span class="text-danger" id="error_password"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label>Repeat Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                              name="password_confirmation"  autocomplete="off"  >
                                        </div>
                                        <span class="text-danger" id="error_password_confirmation"></span>
                                    </div>

                                       <div class="col-md-12">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-block btn-primary"  value="Create"  id="w_btn">
                                        </div>
                                    </div>
                                 
                                 
                                    
                                  
                                </div>

                            </fieldset>

                         

                        </form>
                    </div>
                 </div>




               </div>
               <div role="tabpanel" class="tab-pane " id="employer" aria-labelledby="employer-tab"
                aria-expanded="true">
                
         
                  <div class="card-content  collapse show">
                    <div class="card-body">
                      <table  id="example1" class="table table-responsive">
                         <thead>
                           <tr>
                            <th>#</th>
                             <th>UserName</th>
                             <th>Email</th>
                             <th>Account Permission</th>
                             <th>Account Status</th>
                             <th>Date</th>
                             <th>Action</th>

                           </tr>
                         </thead>
                         <tbody>


                          <?php 
                          if ($data) {
                            $srn = 0;

                           foreach ($data as $data) {
                            $srn ++;
                            ?>

                           <tr>
                            <td>{{$srn}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->user_permission}}</td>
                            <td> @if($data->account_status =='on')
                                           <span class="badge badge-success">Active</span>
                                           @else

                                           <span class="badge badge-warning">Deactivated</span>
                                          @endif</td>
                            <td>{{$data->created_at}}</td>
                                        <td>
                          <span class="dropdown">
                                <button id="btnSearchDrop28" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop28" class="dropdown-menu mt-1 dropdown-menu-right">
                                         @if($data->account_status =='on')
                                          
                                            <a href="/activate_admin/{{$data->id}}" class="dropdown-item" onclick="return confirm('You are trying to  deactivate this user account?')" ><i class="la la-cog danger"></i> Deactivate</a>
                                          @else

                                            <a href="/activate_admin/{{$data->id}}" class="dropdown-item" onclick="return confirm('You  are trying to  activate this user account?')" ><i class="la la-cog success"></i> Activate</a>
                                          @endif

                                            <a href="/delete_admin_account/{{$data->id}}" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this account?')" ><i class="la la-trash danger"></i> Delete</a>
                                </span>
                            </span>
                        </td>  

                           </tr>

                         <?php } } ?>
                         </tbody>



                           <tfooter>
                           <tr>
                            <th>#</th>
                             <th>Account/User Name</th>
                             <th>Email</th>
                             <th>Date</th>
                             <th>Action</th>

                           </tr>
                         </tfooter>
                      </table>
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
           <input type="file" name="profile_pic" class="form-control">
         </label>
        </div>
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