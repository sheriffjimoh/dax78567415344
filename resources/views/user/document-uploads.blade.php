@extends('layouts.app_header')

@section('content')









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


        @if (isset($update))

      <?php foreach ($update as $update) {
      }
  ?>

         <div class="col-xl-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">All your documents both uploaded and received will  be available here</h4>

           <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
        </div>
        <div class="card-content">
          <div class="card-body">
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
              <li class="nav-item">
                <a class="nav-link active" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                  aria-controls="activeIcon1" aria-expanded="true"><i class="ft-upload"></i>Uploaded</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                  aria-expanded="false"><i class="ft-download"></i>Received</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" id="linkIcon1-tab1" data-toggle="tab" href="#updatedocuments" aria-controls="updatedocuments"
                  aria-expanded="false"><i class="ft-plus"></i>Update document</a>
              </li>
             
            </ul>
            <div class="tab-content px-1 pt-1">
              <div role="tabpanel" class="tab-pane active" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
                aria-expanded="true">
               <div class="row">
               	  <div class="col-md-6">
               	  	
                <img src="{{ url('storage/customer_idcards/'.$update->id_card)}}" class="img img-thumbnail" height="300px" width="300px">
                <!-- <embed src="file_name.pdf" width="800px" height="2100px" /> -->
               	  </div>
               	  <div class="col-md-6">
               	  	
                <img src="{{ url('storage/customer_idcards/'.$update->staff_id_card)}}" class="img img-thumbnail" height="300px" width="300px">
               
               	  </div>
               </div>
               <hr>
                 <div class="col-md-12">
                    
                <img src="{{ url('storage/bank_statements/'.$update->bank_statement)}}" class="img img-thumbnail" height="300px" width="800px">
               
                  </div>
              </div>



             
              <div class="tab-pane" id="linkIcon1" role="tabpanel" aria-labelledby="linkIcon1-tab1"
                aria-expanded="false">

                @if($receivefile)

                @foreach($receivefile as $files)

                <div class="card">
                   <div class="card-header">
                      <h3 class="card-title   text-center"> <span class="badge badge-default">{{$files->created_at}}</span></h3>
                   </div>
                   <div class="card-body text-center">
                       <embed src="{{ url('storage/loan_doc/'.$files->loan_doc)}}"  width="600px" height="1750px" />
                   </div>
                   <div class="card-footer">
                      <h3>Bank mandate file,hit download and  take this to your local bank to enable our automate loan repayment for <a href="user_loan_details">this</a>  loan</h3>
                      <a  class="btn btn-primary" title="Tomxcredit Mandate file" href="{{ url('storage/loan_doc/'.$files->loan_doc)}}" download="Tomxcredit Mandate file"><i class="la la-download"></i></a>
                   </div>

                </div>
    

                @endforeach
                @endif
              </div>



               <!-- update documents -->
              <div class="tab-pane" id="updatedocuments" role="tabpanel" aria-labelledby="updatedocuments-tab1"
                aria-expanded="false">




                <div class="card-header offset-md-4">
                    <h4 class="card-title">Please Provide Your Documents to update
                    	<ul>
                    		<li>Your Personal  ID CARD</li>
                    		<li>Your Employer  ID  CARD</li>
                        <li>Clear Bank Statement Document/li>
                  
                    	</ul></h4>
                    	

                    	<p>What this means? <a href="#">Learn more </a></p>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                   
                </div>


                <div class="card-content offset-md-4 collapse show">
                    <div class="card-body">
                        <form action="/updatedocuments"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                        	<h6><i class="step-icon la la-files-o"></i>Documents</h6>
                            <br>
                            
                           {{ csrf_field() }}
                            <!-- Step 1 -->
                            <h6><i class="step-icon la la-file"></i> Your Personal  ID CARD</h6>
                            <fieldset>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
									      <span>Choose file</span>
									      <input type="file" name="personal_idcard" id="personal_idcard">
									    </div>
                      <span id="display-personal_idcard"></span>
                                    </div>
                                </div>
                            </fieldset>
                          <!-- Step 1 -->
                          <br>
                            <h6><i class="step-icon la la-file"></i>Your Employer  ID  CARD</h6>
                            <fieldset>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
									      <span>Choose file</span>
									      <input type="file" name="employer_idcard" id="employer_idcard">
									    </div>
                        <span id="display-employer_idcard"></span>
                                    </div>
                                </div>
                            </fieldset>

                                  <!-- Step 1 -->
                            
                                  <br>
                                  <br>
                                  <br>
                            <h6><i class="step-icon la la-bank"></i>Bank Statement Details</h6>
                            <br>
                            <fieldset>
                             <label for="password"><i class="step-icon la la-lock"></i>Upload Bank Satement</label>
                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
                          <span>Choose file</span>
                          <input type="file" name="bank_statement" id="bank_statement">
                        </div>
                          <span id="display-bank_statement"></span>
                                    </div>
                                </div>

                            </fieldset>

                             <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                      <br><br>
                                       <p class="text-danger">Please,  ensure that you provide clean and clear picture of your <strong>ID CARDS </strong> and a valid  <strong>bank statement</strong> , to avoid loan application process delay or rejected</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-primary btn-block" value="Update"  >
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

       @else
        <div class="card-header offset-md-4">
                    <h4 class="card-title">Please Provide Your Document 
                    	<ul>
                    		<li>Your Personal  ID CARD</li>
                    		<li>Your Employer  ID  CARD</li>
                    	</ul></h4>
                    	<h4 class="card-title">Provide Bank Statement Details
                    	<ul>
                    		<li>Clear Bank Statement Document</li>
                  
                    	</ul></h4>

                    	<p>What this means? <a href="#">Learn more </a></p>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>


                <div class="card-content offset-md-4 collapse show">
                    <div class="card-body">
                        <form action="/updatedocuments"  enctype="multipart/form-data" method="Post" class="icons-tab-steps wizard-circle " autocomplete="off">
                       
                            <h6><i class="step-icon la la-files-o"></i>Documents</h6>     
                           {{ csrf_field() }}
                            <!-- Step 1 -->
                            <h6><i class="step-icon la la-file"></i> Your Personal  ID CARD</h6>
                            <fieldset>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
                        <span>Choose file</span>
                        <input type="file" name="personal_idcard" id="personal_idcard">
                      </div>
                      <span id="display-personal_idcard"></span>
                                    </div>
                                </div>
                            </fieldset>
                          <!-- Step 1 -->
                          <br>
                            <h6><i class="step-icon la la-file"></i>Your Employer  ID  CARD</h6>
                            <fieldset>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
                        <span>Choose file</span>
                        <input type="file" name="employer_idcard" id="employer_idcard">
                      </div>
                        <span id="display-employer_idcard"></span>
                                    </div>
                                </div>
                            </fieldset>

                                  <!-- Step 1 -->
                            
                                  <br>
                                  <br>
                                  <br>
                            <h6><i class="step-icon la la-bank"></i>Bank Statement Details</h6>
                            <br>
                            <fieldset>
                             <label for="password"><i class="step-icon la la-lock"></i>Upload Bank Satement</label>
                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="btn btn-primary btn-sm float-left">
                          <span>Choose file</span>
                          <input type="file" name="bank_statement" id="bank_statement">
                        </div>
                          <span id="display-bank_statement"></span>
                                    </div>
                                </div>

                            </fieldset>

                             <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                      <br><br>
                                       <p class="text-danger">Please,  ensure that you provide clean and clear picture of your <strong>ID CARDS </strong> and a valid  <strong>bank statement</strong> , to avoid loan application process delay or rejected</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <input type="submit" class="btn btn-primary btn-block" value="Update"  >
                                        </div>
                                    </div>

                                    
                                </div>

                            </fieldset>
                        

                        </form>
                    </div>
                </div>
       @endif

               
            </div>
        </div>
    </div>
</section>
<!-- Form wizard with icon tabs section end -->


@endsection