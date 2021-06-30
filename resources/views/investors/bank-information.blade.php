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
        <h3>Bank Account Information , Update Bank Account Information</h3>
       </div>
         <div class="card-content">
          <div class="card-body">
           <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal"
                  aria-controls="personal" aria-expanded="true"><i class="la la-user"></i> &nbsp;Bank Account Information</a>
              </li>
              
               <li class="nav-item">
                <a class="nav-link " id="account-tab" data-toggle="tab" href="#account"
                  aria-controls="account" aria-expanded="true"><i class="la la-bank"></i> &nbsp;{{(!empty($info->bank_account_number)? 'Update' : 'Create')}} Bank Information</a>
              </li>
             
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="personal"
                aria-expanded="true">

              <div class="card-content  collapse show">
                 <div class="card-body">
                  <div class="col-sm-4 offset-lg-4">
                    <?php if ($info->bank_name) { ?>
                     <ul class="list-group">
                        <li class="list-group-item">Bank Name : <span class="pull-right">{{$info->bank_name}}</span> </li>

                        <li class="list-group-item">Account Number : <span class="pull-right">{{$info->bank_account_number}}</span></li>

                        <li class="list-group-item">Account Type : <span class="pull-right">{{$info->bank_account_type}}</span></li>

                     </ul>

                   <?php } ?>
                  </div>
                      

                  </div>
                </div>
               </div>

               <div role="tabpanel" class="tab-pane" id="account" aria-labelledby="account-tab"
                aria-expanded="true">

                  <div class="card-content  collapse show">
                    <div class="card-body">
                        <form action="update_personal_info"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-bank"></i>{{(!empty($info->bank_account_number)? 'Update' : 'Create')}} Bank Account Information</h6>
                            <br>
                            <fieldset class="col-sm-4 offset-lg-4">
                                        <div class="form-group">
                                            <label>Bank name</label> 
                                            <select aria-label="bank" aria-describedby="basic-addon1" class="form-control " id="bank" name="bank_code">
                                              <option selected value="{{$info->bank_name}}" >{{$info->bank_name}}</option>
                                              <option value="044">Access Bank</option>
                                              <option value="023">Citibank Nigeria</option>
                                              <option value="063">Access(Diamond) Bank</option>
                                              <option value="050">Ecobank Nigeria</option>
                                              <option value="070">Fidelity Bank</option>
                                              <option value="011">First Bank of Nigeria</option>
                                              <option value="214">First City Monument Bank</option>
                                               <option value="058">Guaranty Trust Bank</option>
                                               <option value="030">Heritage Bank</option>
                                               <option value="082">Keystone Bank</option>
                                               <option value="076">Polaris Bank</option>
                                               <option value="221">Stanbic IBTC Bank</option>
                                               <option value="068">Standard Chartered Bank</option>
                                               <option value="232">Sterling Bank</option>
                                               <option value="000">Suntrust Bank</option>
                                               <option value="032"> Union Bank of Nigeria</option>
                                               <option value="033">United Bank For Africa</option>
                                               <option value="215">Unity Bank</option>
                                               <option value="035">Wema Bank</option>
                                               <option value="057">Zenith Bank</option>
                                               <option value="084"> Enterprise Bank</option>
                                               <option value="014">MainStreet Bank</option>
                                               <option value="035A">ALAT by WEMA</option>
                                               <option value="401">ASO Savings and Loans</option>
                                               <option value="50823">CEMCS Microfinance Ban</option>
                                            </select>
                                        </div>
                                        <span class="text-danger" id="error_bank_name"></span>
                                   
                                        <div class="form-group">
                                            <label>Account number</label>
                                            <input type="text" class="form-control" id="bank_account_number"  name="bank_account_number"  autocomplete="off" value="{{$info->bank_account_number}}">
                                        </div>
                                        <span class="text-danger" id="error_bank_account_number"></span>
                                   
                                 <div class="form-group">
                                            <label>Account Type</label>

                                            <select class="form-control" id="bank_account_type"  name="bank_account_type"  autocomplete="off">
                                              <option selected value="{{$info->bank_account_type}}">{{$info->bank_account_type}}</option>
                                                    <option value="Saving">Saving</option>
                                                    <option value="current">current</option>
                                           </select>
                                        </div>

                                         <div class="form-group"> 
                                            <input type="submit" class="btn btn-block btn-primary" 
                                             value="{{(!empty($info->bank_account_number)? 'Update' : 'Create')}}"  id="w_btn">
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

                    <!-- Invoices List table -->
</section>

</div></div></div>
<!-- Form wizard with icon tabs section end -->


@endsection