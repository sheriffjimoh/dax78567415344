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
                  aria-controls="personal" aria-expanded="true"><i class="la la-user"></i> &nbsp;Personal</a>
              </li>
               <li class="nav-item">
                <a class="nav-link " id="employer-tab" data-toggle="tab" href="#employer"
                  aria-controls="employer" aria-expanded="true"><i class="la la-credit-card"></i> &nbsp;Employer</a>
              </li>
               <li class="nav-item">
                <a class="nav-link " id="account-tab" data-toggle="tab" href="#account"
                  aria-controls="account" aria-expanded="true"><i class="la la-bank"></i> &nbsp;Account(Bank Details)</a>
              </li>
             
           
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="personal"
                aria-expanded="true">




              <div class="card-content  collapse show">
                    <div class="card-body">
                        <form action="update_personal_info"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-user"></i> Personal Information</h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="title"  name="title"  autocomplete="off" value="{{$info->title}}">
                                        </div>
                                        <span class="text-danger" id="error_title"></span>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" id="firstname"  name="firstname"  autocomplete="off" value="{{$info->firstname}}">
                                        </div>
                                        <span class="text-danger" id="error_firstname"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" class="form-control" id="lastname"  name="lastname"  autocomplete="off" value="{{$info->lastname}}">
                                        </div>
                                        <span class="text-danger" id="error_lastname"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Email</label>
                                            <input type="email" class="form-control" id="email"  name="email"  autocomplete="off"  value="{{$info->email}}">
                                        </div>
                                        <span class="text-danger" id="error_email"></span>
                                    </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Phone</label>
                                            <input type="number" class="form-control" id="phone"  name="phone"  autocomplete="off"  value="{{$info->phone}}">
                                        </div>
                                        <span class="text-danger" id="error_phone"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Marital Status</label>
                                          <select class="form-control" id="marital"  name="marital"  autocomplete="off">
                                              <option selected value="{{$info->marital_status}}">{{$info->marital_status}}</option>
                                              <option value="single">Single</option>
                                              <option value="married">married</option>
                                           </select>
                                        </div>
                                        <span class="text-danger" id="error_marital"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Depandant</label>
                                          <select class="form-control" id="dependants"  name="dependants"  autocomplete="off">
                                              <option selected value="{{$info->dependants}}">{{$info->dependants}}</option>
                                              <option value="1-10">1-10</option>
                                              <option value="1-20">1-20</option>
                                           </select>
                                        </div>
                                        <span class="text-danger" id="error_dependants"></span>
                                    </div><div class="col-md-4">
                                        <div class="form-group">
                                           <label>Education</label>
                                            <input type="text" class="form-control" id="education"  name="education"  autocomplete="off" value="{{$info->education}}">
                                        </div>
                                        <span class="text-danger" id="error_education"></span>
                                    </div><div class="col-md-4">
                                        <div class="form-group">
                                         <label>State of Origin</label>
                                            <select class="form-control" id="resident_state"  name="resident_state"  autocomplete="off">
                                              <option selected value="{{$info->resident_state}}">{{$info->resident_state}}</option>
                                              <option value="1-10">1-10</option>
                                              <option value="1-20">1-20</option>
                                           </select>
                                        </div>
                                        <span class="text-danger" id="error_state"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Address</label>
                                            <input type="text" class="form-control" id="house_address"  name="house_address"  autocomplete="off" value="{{$info->house_address}}">
                                        </div>
                                        <span class="text-danger" id="error_address"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>LGA of Origin</label>
                                            <select class="form-control" id="lga"  name="lga"  autocomplete="off">
                                              <option selected value="{{$info->lga}}">{{$info->lga}}</option>
                                              <option value="ilorin west">ilorin west</option>
                                              <option value="ilorin east">ilorin east</option>
                                           </select>
                                        </div>
                                        <span class="text-danger" id="error_lga"></span>
                                    </div>
                                </div>

                                <h4>Next of kin</h4>

                                <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Fullname</label>
                                            <input type="text" class="form-control" id="fullname"  name="fullname"  autocomplete="off" value="{{$info->fullname}}">
                                        </div>
                                        <span class="text-danger" id="error_fullname"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Phone</label>
                                            <input type="text" class="form-control" id="phone"  name="kin_phone"  autocomplete="off" value="{{$info->kin_phone}}">
                                        </div>
                                        <span class="text-danger" id="error_phone"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Relationship</label>

                                            <select class="form-control" id="relationship"  name="relationship"  autocomplete="off">
                                              <option selected value="{{$info->relationship}}">{{$info->relationship}}</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Son">Son</option>
                                                    <option value="Daughter">Daughter</option>
                                           </select>

                                        </div>
                                        <span class="text-danger" id="error_relationship"></span>
                                    </div>
                                </div>
                               

                            </fieldset>

                            
                             <fieldset>


                                <div class="row">
                                    <div class="col-md-4">
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
               <div role="tabpanel" class="tab-pane " id="employer" aria-labelledby="employer-tab"
                aria-expanded="true">
                                  <div class="card-content  collapse show">
                    <div class="card-body">
                        <form action="update_personal_info"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-credit-card"></i> Employer Information</h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employer name</label>
                                            <input type="text" class="form-control" id="employer_name"  name="employer_name"  autocomplete="off" value="{{$info->employers_name}}">
                                        </div>
                                        <span class="text-danger" id="error_employer_name"></span>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employer start date</label>
                                            <input type="text" class="form-control" id="employer_startdate"  name="employer_startdate"  autocomplete="off" value="{{$info->employers_startdate}}">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Monthly Income</label>
                                            <input type="text" class="form-control" id="income"  name="income"  autocomplete="off" value="{{$info->monthly_income}}">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Monthly Loan Repayment</label>
                                            <input type="text" class="form-control" id="employers_loan_repayment"  name="repayment"  autocomplete="off" value="{{$info->employers_loan_repayment}}">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employers Loan Amount</label>
                                            <input type="text" class="form-control" id="employers_loan_amount"  name="employer_loanamount"  autocomplete="off" value="{{$info->employers_loan_amount}}">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employers Loan Tenure</label>
                                            <input type="text" class="form-control" id="employers_loan_Tenure"  name="employer_loantenure"  autocomplete="off" value="{{$info->employers_loan_tenure}}">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employers Email</label>
                                            <input type="text" class="form-control" id="employers_email"  name="officemail"  autocomplete="off" value="{{$info->employers_email}}">
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employers Address</label>
                                            <input type="text" class="form-control" id="employers_Address"  name="employer_address"  autocomplete="off" value="{{$info->employers_address}}">
                                        </div>
                                    </div>
                                    
                                </div>
                               

                            </fieldset>

                            
                             <fieldset>


                                <div class="row">
                                    <div class="col-md-4">
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
               <div role="tabpanel" class="tab-pane" id="account" aria-labelledby="account-tab"
                aria-expanded="true">





                                              <div class="card-content  collapse show">
                    <div class="card-body">
                        <form action="update_personal_info"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                               <h6><i class="step-icon la la-bank"></i> Account Information</h6>
                            <br>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
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
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account number</label>
                                            <input type="text" class="form-control" id="bank_account_number"  name="bank_account_number"  autocomplete="off" value="{{$info->bank_account_number}}">
                                        </div>
                                        <span class="text-danger" id="error_bank_account_number"></span>
                                    </div>
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account Type</label>

                                            <select class="form-control" id="bank_account_type"  name="bank_account_type"  autocomplete="off">
                                              <option selected value="{{$info->bank_account_type}}">{{$info->bank_account_type}}</option>
                                                    <option value="Saving">Saving</option>
                                                    <option value="current">current</option>
                                           </select>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                               

                            </fieldset>

                            
                             <fieldset>


                                <div class="row">
                                    <div class="col-md-4">
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

                    <!-- Invoices List table -->
</section>

</div></div></div>
<!-- Form wizard with icon tabs section end -->


@endsection