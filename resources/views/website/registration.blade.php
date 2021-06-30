<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="content ">

       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     <title>{{ config('app.name', 'Laravel') }} - Registration </title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('website-assets/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!--  style -->
  <link rel="stylesheet" type="text/css" href="{{ asset ('reg-assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('reg-assets/css/style.css')}}  ">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <!-- As a heading -->
    <nav class="navbar navbar-light ">
      <span class="navbar-brand mb-0 h1">
        <a href="/"> <img src="{{ asset('website-assets/img/Daxlinks-logo.png')}}"></a></span>
    </nav>



    <div class="main-mix">
      <div class="mix-list col-xs-10">


        <div class="mix-items col-xs-3 " id="bvn-progress">
          <div class="item-icon  ">
            <span ><i class="fa fa-shield"></i></span>
          </div>
          <div class="mid-dot">
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            BVN Verification
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
              <span></span>
             </div>
          </div>

           <div class="mix-items col-xs-3 " id="personal-progress">
          <div class="item-icon">
            <span><i class="fa fa-user-circle-o"></i></span>
          </div>
          <div class="mid-dot" >
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            Personal Details
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
              
              <span></span>
             </div>
          </div>

          <div class="mix-items col-xs-3 " id="employer-progress">
          <div class="item-icon">
            <span><i class="fa  fa-id-card"></i></span>
          </div>
          <div class="mid-dot">
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            Employer Details
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
              <span></span>
             </div>
          </div>
                  

                   <div class="mix-items col-xs-3  " id="loan-progress">
          <div class="item-icon">
            <span><i class="fa  fa-file"></i></span>
          </div>
          <div class="mid-dot">
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            Loan Details
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
               <span></span>
             </div>
          </div>
                          

                   <div class="mix-items  col-xs-3 "  id="account-progress">
          <div class="item-icon">
            <span><i class="fa  fa-credit-card"></i></span>
          </div>
          <div class="mid-dot" >
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            Account Details
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
              <span></span>
             </div>
          </div>
<!-- 
                   <div class="mix-items  col-xs-3  " id="statement-progress">
          <div class="item-icon">
            <span><i class="fa fa-cloud-upload"></i></span>
          </div>
          <div class="mid-dot">
            <span><i class="fa fa-check-circle"></i></span>
          </div>
          <div class="item-text">
            Statement
          </div>
        </div>
          <div class="progress">
             <div class="progress-bar">
              <span></span>
             </div>
          </div> -->


      </div>
    </div>
               



               <div class="container-fluid">
                <form class="form-horizontal" id="reg-form" action="{{ route('registrations.store') }}" enctype=" multipart/form-data">
                  <input id="signup-token" name="token" type="hidden" value="{{csrf_token()}}">
              
                 <div class="col-lg-6 offset-lg-3 ">

                   <div id="msg">
                 
                   </div>
                </div>
                 
                <div class="row form ">


                   <div class="nestedrow my-inputs" id="bvn">


                    <div class="col-xs-12 col-lg-12 ">
                    <div class="row">


                     <div  class="col-lg-4 text-line ">
                  
                     <h3 class="lead"><span class="color-b-line"> BVN </span> Verification</h3>
                      </div>
                    
                     <div  class="col-lg-8 col-xs-8 col-sm-8" id="bvnbox">
                        <div class="input-group mb-1 input-n bvn-n">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1">#</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Bank Verification Number"  id="bvninput">

                        </div> 
                        <div class="error-msg">
                           <span id='bvn-error'></span>
                        </div>
                       
                         <div class="col-lg-12 col-12 checkbox">
                            <label class="container">Accept all <span class="col-prim">&nbsp;Term & Condition</span>
                            <input type="checkbox" name="term" id="term">
                              <span class="checkmark"></span>
                            </label>
                      </div>
                       <div class="col-lg-12 col-12 checkbox">
                              <label class="container">Accept  <span class="col-prim">&nbsp;Private Policy</span>
                              <input type="checkbox" name="privacy" id="privacy">
                              <span class="checkmark"></span>
                              </label>
                      </div>
                       <div class="error-msg">
                           <span id='termp-error'></span>
                        </div>
                      <div class="col-lg-12 col-12 checkbox">
                             <p>I have read, understood and accept all the terms and<br> conditions & privacy policy for Tomx Credit Limited (RC 1696433).</p>                       </div>

                      <div class="spinner-border text-primary text-center" role="status" id="spin" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#" id="btn-bvn" class="btn btn-fefault btn-submit ">
                      
                       Next</a> 
                      </div>
                     <!-- </div> -->


                    <div  class="col-lg-8 " id="codebox">
                        <div class="input-group mb-1 input-n bvn-n">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1">#</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Enter Code"  id="codeinput">

                        </div> 
                        <div class="error-msg">
                           <span id='code-error'></span>
                        </div>
                         <input type="hidden" id="coden">
                          <input type="hidden" id="user_bvn">
                      <div class="col-lg-12 col-12 checkbox">
                             <p>We have sent  a six digit code to the phone number<br>(********<span id="userphone"></span>) that was attached   to the provided bvn, look through your inbox.</p>                   
                        </div>

                      <div class="spinner-border text-primary text-center" role="status" id="spin" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#" id="btn-code" class="btn btn-fefault btn-submit ">
                      
                       Next</a> 
                      </div>
                     </div>


                   </div>
                  </div>



                 <!-- end BVN -->
                </div>
                








                <!-- Personal details -->


                  <div class="steps my-inputs" id="personal">



                   <div class="col-xs-12 col-lg-12">
                    <div class="row">


                     <div  class="col-lg-3 text-line ">
                     <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3>
                      </div>
                    
                     <div  class="col-lg-2">
                      <div class="input-group mb-2 input-n title-err-line">
                       <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o"></i></span>
                       </div>
                       <select aria-label="bvn" aria-describedby="basic-addon1" class="form-control" id="title">
                       <option value=""  selected="" disabled="disabled" >Title</option>
                       <option value="mr">mr. </option>
                        <option value="mrs">mrs. </option>
                        <option value="miss">miss. </option>
                      </select>
                  <!-- <input type="text"  placeholder="Bank Verification Number" > -->
                       </div>

                        <div class="error-msg">
                           <span id='title-error'></span>
                        </div>
                      </div>
                      

                         <input type="hidden" id="codep">

                       <div  class="col-lg-3 ">
                          <div class="input-group mb-2 input-n firstname-err-line">
                           <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="First name" aria-label="firstname" aria-describedby="basic-addon1" id="firstname">
                          </div>
                           <div class="error-msg">
                           <span id='firstname-error'></span>
                        </div>
                        </div>
                        

                        <div  class="step-list  col-lg-3 ">
                           <div class="input-group mb-2 input-n lastname-err-line">
                           <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="Last name" aria-label="lastname" aria-describedby="basic-addon1" id="lastname">
                          </div>
                           <div class="error-msg">
                           <span id='lastname-error'></span>
                        </div>
                        </div>
                        
                      </div>
                   </div>

                <div class="col-xs-12 col-lg-12">
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2 input-n  email-err-line">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                              </div>
                            <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" id="email">
                         </div>
                          <div class="error-msg">
                           <span id='email-error'></span>
                        </div>
                      </div>

                        
                        <div  class="col-lg-4 ">

                      <div class="input-group mb-2 input-n phone-err-line">
                         <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" title="phone number" placeholder="Phone"  aria-label="dob" aria-describedby="basic-addon1" id="phone"> 

                      </div>
                       <div class="error-msg">
                           <span id='phone-error'></span>
                        </div>
                    </div>


                    </div>
                  </div>

                  <div class="col-xs-12 col-lg-12">
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2 input-n dependent-err-line">
                           <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                              </div>  
                           <select aria-label="dependent" aria-describedby="basic-addon1" class="form-control" 
                            id="dependent">
                                <option selected=" " value="" disabled>Number Of Dependents</option>
                                <option value="1-10">1-10</option>
                                <option value="10-20">10-20</option>
                                <option value="20-30">20-30</option>
                            </select>
                         </div>
                         <div class="error-msg">
                           <span id='dependent-error'></span>
                        </div>
                      </div>
                       <div  class="col-lg-4 ">
                        <div class="input-group  input-n mb-2  education-err-line">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-mortar-board"></i></span>
                          </div>
                       <select aria-label="marital" aria-describedby="basic-addon1" class="form-control" id="education">
                            <option selected="" value="" disabled>Highest Level Of Education</option>
                            <option value="o'Level">O'level</option>
                            <option value="national diploman">OND</option>
                            <option value="nce">NCE</option>
                            <option value="higher national diploman">HND</option>
                            <option value="Bachelor degree">Bachelor Degree</option>
                            <option value="Doctorate">Doctorate</option>
                        </select>
                      </div>
                       <div class="error-msg">
                           <span id='education-error'></span>
                        </div>
                    </div>
                  </div>
                </div>

                 <div class="col-xs-12 col-lg-12">
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2 input-n info-err-line ">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-info"></i></span>
                          </div>
                         <select aria-label="marital" aria-describedby="basic-addon1" class="form-control" id="info">
                            <option selected="" value="" disabled>How Do You Hear About Us ? </option>
                            <option value="social medial">Social Media</option>
                            <option value="friends">Friends</option>
                            <option value="home">Homies/relative</option>
                        
                          </select>
                         </div>
                          <div class="error-msg">
                           <span id='info-error'></span>
                        </div>

                      </div>
                       <div  class="col-lg-4 ">
                          <div class="input-group input-n mb-2 marital-err-line ">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-heart-o"></i></span>
                            </div>  
                         <select aria-label="marital" aria-describedby="basic-addon1" class="form-control" id="marital">
                              <option selected="" value="" disabled>Marital Status</option>
                              <option value="single">Single</option>
                              <option value="married">Married</option>
                         </select>
                          </div>
                           <div class="error-msg">
                           <span id='marital-error'></span>
                        </div>
                      </div>

                  </div>
                </div>
                   <div class="col-xs-12 col-lg-12">
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2  input-n  state-err-line">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-home"></i></span>
                          </div>  
              <select
                  onchange="toggleLGA(this);"
                  name="state"
                  id="state"
                  class="form-control"
                >
                  <option value="" selected="selected">- Select  State Of Resident-</option>
                  <option value="Abia">Abia</option>
                  <option value="Adamawa">Adamawa</option>
                  <option value="AkwaIbom">AkwaIbom</option>
                  <option value="Anambra">Anambra</option>
                  <option value="Bauchi">Bauchi</option>
                  <option value="Bayelsa">Bayelsa</option>
                  <option value="Benue">Benue</option>
                  <option value="Borno">Borno</option>
                  <option value="Cross River">Cross River</option>
                  <option value="Delta">Delta</option>
                  <option value="Ebonyi">Ebonyi</option>
                  <option value="Edo">Edo</option>
                  <option value="Ekiti">Ekiti</option>
                  <option value="Enugu">Enugu</option>
                  <option value="FCT">FCT</option>
                  <option value="Gombe">Gombe</option>
                  <option value="Imo">Imo</option>
                  <option value="Jigawa">Jigawa</option>
                  <option value="Kaduna">Kaduna</option>
                  <option value="Kano">Kano</option>
                  <option value="Katsina">Katsina</option>
                  <option value="Kebbi">Kebbi</option>
                  <option value="Kogi">Kogi</option>
                  <option value="Kwara">Kwara</option>
                  <option value="Lagos">Lagos</option>
                  <option value="Nasarawa">Nasarawa</option>
                  <option value="Niger">Niger</option>
                  <option value="Ogun">Ogun</option>
                  <option value="Ondo">Ondo</option>
                  <option value="Osun">Osun</option>
                  <option value="Oyo">Oyo</option>
                  <option value="Plateau">Plateau</option>
                  <option value="Rivers">Rivers</option>
                  <option value="Sokoto">Sokoto</option>
                  <option value="Taraba">Taraba</option>
                  <option value="Yobe">Yobe</option>
                  <option value="Zamfara">Zamafara</option>
                        
                          </select>
                         </div>
                            <div class="error-msg">
                           <span id='state-error'></span>
                        </div>
                      </div>
                       <div  class="col-lg-4 ">
                        <div class="input-group mb-2 input-n address-err-line">
                         <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <textarea class="form-control" placeholder="House Address" aria-label="dob" aria-describedby="basic-addon1" id="address"></textarea>

                      </div>
                       <div class="error-msg">
                           <span id='address-error'></span>
                        </div>

                    </div>
                  </div>
                </div>

                   <div class="col-xs-12 col-lg-12">
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2  input-n  local-err-line ">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-home"></i></span>
                          </div>
                             <select   name="lga" id="local" class="form-control select-lga" required >

                            </select>

                         </div>
                          <div class="error-msg">
                           <span id='local-error'></span>
                        </div>
                      </div>

                      <div  class="col-lg-4 ">
                        <div class="input-group mb-2  input-n ">
                         <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-plus"></i></span>
                          </div>  
                          <input type="text" class="form-control" placeholder="Referral code(optional)" aria-label="dob" aria-describedby="basic-addon1" id="referer"> 

                      </div>
                    </div>
                    
                  </div>
                </div>



                   <div class="col-xs-12 col-lg-12 nextofkin">
                    <label>Next Of Kin Infomation</label>
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2 input-n  fullname-err-line">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o"></i></span>
                          </div>  
                          <input type="text" class="form-control" title="Fullname" placeholder="Fullname"  aria-label="dob" aria-describedby="basic-addon1" id="fullname"> 
                         </div>
                          <div class="error-msg">
                           <span id='fullname-error'></span>
                        </div>
                      </div>
                       <div  class="col-lg-4 ">
                        <div class="input-group mb-2 input-n kinphone-err-line">
                         <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" title="phone number" placeholder="Phone"  aria-label="dob" aria-describedby="basic-addon1" id="kin_phone"> 

                      </div>
                       <div class="error-msg">
                           <span id='kinphone-error'></span>
                        </div>
                    </div>
                  </div>
                </div>
                    
                   <div class="col-xs-12 col-lg-12">
        
                   <div class="row">
                      <div  class="step-list  col-lg-3 ">
                     <!-- <h3 class="lead"><span class="color-b-line"> Personal </span> Details</h3> -->
                      </div>
                       <div  class="col-lg-4">
                         <div class="input-group mb-2  input-n relationship-err-line">
                         <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-home"></i></span>
                          </div>  
                          <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="relationship">
                            <option selected disabled>Select  Relationship</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Uncle">Uncle</option>                           
                            <option value="Brother">Brother</option>
                        
                          </select>

                         </div>
                          <div class="error-msg">
                           <span id='relationship-error'></span>
                        </div>
                      </div>
                       <div  class="col-lg-4 ">
                        <div class="input-group mb-2 ">
                       <div class="spinner-border text-primary text-center" role="status" id="spin-pers" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                          <a href="#" id="btn-personal" class="btn btn-fefault btn-submit " >Next</a>
                      </div>
                    </div>
                  </div>
                </div>



                  


               
          </div>
          <!-- end Personal details -->
           
















            <!-- Employer details -->


                  <div class="steps my-inputs" id="employer">



                   <div class="col-xs-12 col-lg-12">
                    <div class="row">


                     <div  class="col-lg-3 text-line ">
                     <h3 class="lead"><span class="color-b-line"> Employer </span> Details</h3>
                      </div>
                    
                         
                          <input type="hidden" id="codee">
                    
                     <div  class="col-lg-4">
                        <div class="input-group mb-2 input-n employername-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-briefcase"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Employer name" aria-label="bvn" aria-describedby="basic-addon1" id="employer_name">
                        </div>
                          <div class="error-msg">
                           <span id='employername-error'></span>
                        </div>
                         <div class="input-group mb-2 input-n  employerstartdate-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="date" class="form-control" placeholder="Employement Start date" aria-label="bvn" aria-describedby="basic-addon1" id="employer_startdate">
                        </div>
                         <div class="error-msg">
                           <span id='employerstartdate-error'></span>
                        </div>
                         
                          <div class="input-group mb-2 input-n income-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-hand-rock-o "></i></span>
                          </div>
                          <input type="number" class="form-control" placeholder="Net Monthly Income" aria-label="bvn" aria-describedby="basic-addon1" id="income">
                        </div>
                          <div class="error-msg">
                           <span id='income-error'></span>
                        </div>
                          <div class="input-group mb-2 input-n repayment-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-handshake-o"></i></span>
                          </div>
                          <input type="number" class="form-control" placeholder="Other Monthly Loan Repayments" aria-label="bvn" aria-describedby="basic-addon1" id="repayment">
                        </div>
                         <div class="error-msg">
                           <span id='repayment-error'></span>
                        </div>
                         <label class="text-label">Previous Loan Amount</label>
                        <div class="input-group mb-2 input-n loanamount-err-line">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-money"></i></span>
                          </div>
                          <input type="number" class="form-control" placeholder="previous Loan Amount" aria-label="bvn" aria-describedby="basic-addon1" id="loanamount">
                        </div>
                         <div class="error-msg">
                           <span id='loanamount-error'></span>
                        </div>
                          <label class="text-label">Previous Loan Tenure</label>
                        <div class="input-group mb-2 input-n loantenure-err-line">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-clock-o"></i></span>
                          </div>
                           <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="loantenure">
                            <option selected="" value="" disabled>Select Loan tenure</option>
                           <option value="1">Pay day</option>
                            <option value="2">2 month</option>
                            <option value="3">3 month</option>
                            <option value="4">4 month</option>
                            <option value="5">5 month</option>
                            <option value="6">6 month</option>
                            <option value="7">7 month</option>
                            <option value="8">8 month</option>
                            <option value="9">9 month</option>
                        
                          </select>
                        </div>
                         <div class="error-msg">
                           <span id='loantenure-error'></span>
                        </div>

                         <div class="input-group mb-2 input-n  officemail-err-line">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Official Email" aria-label="bvn" aria-describedby="basic-addon1" id="officemail">
                        </div>
                         <div class="error-msg">
                           <span id='officemail-error'></span>
                        </div>

                         <!-- <div class="input-group mb-2 input-n text-center">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card-o"></i></span>
                          </div>
                          <img src="">
                          <input type="text" class="form-control" placeholder="Official Email" aria-label="bvn" aria-describedby="basic-addon1"> 
                        </div> -->

                        <!--   <div class="input-group mb-2  input-n">
                           <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card-o"></i></span>
                          </div>  

                          <input type="file" class="form-control" title="upload government ID card" placeholder="upload government ID"  aria-label="dob" aria-describedby="basic-addon1"> 
                          <label class="label-file">Upload staff ID</label>
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-cloud-upload"></i></span>
                          </div> 
                      </div> -->
                         

                          <div class="input-group mb-2 input-n  empaddress-err-line">
                         <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <textarea class="form-control" placeholder="Employer Address" aria-label="dob" aria-describedby="basic-addon1" id="empaddress"></textarea>
                            <!-- <input type="text" >  -->

                      </div>
                       <div class="error-msg">
                           <span id='empaddress-error'></span>
                        </div>
                         
                      <div class="spinner-border text-primary text-center" role="status" id="spin-em" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#"  id="btn-employer" class="btn btn-fefault btn-submit ">Next</a>
                      </div>
                     </div>
                   

                  


               
              </div>
          </div>
      </div>
          <!-- end Employer details -->
            


             <!--  Loan details -->


                  <div class="steps my-inputs" id="loan">



                   <div class="col-xs-12 col-lg-12">
                    <div class="row">
                  
                          <input type="hidden" id="codel">

                     <div  class="col-lg-3 text-line ">
                     <h3 class="lead"><span class="color-b-line"> Loan </span> Details</h3>
                      </div>
                    
                          <div  class="col-lg-4 ">
                            <label class="text-label">Loan Amount</label>
                        <div class="input-group mb-2 input-n lamount-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-money"></i></span>
                          </div>
                          <input type="number" class="form-control" placeholder="Loan Amount ₦" aria-label="bvn" aria-describedby="basic-addon1" id="real_loanamount">
                        </div>
                         <div class="error-msg">
                           <span id='lamount-error'></span>
                        </div>
                         
                          <label class="text-label">Loan Tenure</label>
                         <div class="input-group mb-2 input-n ltenure-err-line">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-clock-o"></i></span>
                          </div>
                           <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="real_loantenure">
                            <option selected='' value=" " disabled>Loan tenure</option>
                             <option value="1">Pay day</option>
                            <option value="2">2 month</option>
                            <option value="3">3 month</option>
                            <option value="4">4 month</option>
                            <option value="5">5 month</option>
                            <option value="6">6 month</option>
                            <option value="7">7 month</option>
                            <option value="8">8 month</option>
                            <option value="9">9 month</option>
                         </select>
                        </div>
                         <div class="error-msg">
                           <span id='ltenure-error'></span>
                        </div>
                        
                      <div class="col-lg-12 col-12 checkbox">
                        <p class="text-danger"><span id="interest-rate"></span></p>
                        <div class="row">
                          <div class="col-lg-6">
                            <p>Your Monthly Repayment will be:</p>
                          </div>
                          <div class="col-lg-6">
                            <span class="amount-lt" id="repayround"></span>
                          </div>
                        
                             
                         </div>                       
                       </div>
                        <div class="spinner-border text-primary text-center" role="status" id="spin-l" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#"  id="btn-loan" class="btn btn-fefault btn-submit ">Next</a>
                      </div>
                     </div>

                    

                  


               
              </div>
          </div>
      </div>
          <!-- end Loan details -->


             <!--  Account details -->


                  <div class="steps my-inputs" id="account">



                   <div class="col-xs-12 col-lg-12">
                    <div class="row">
                     <input type="hidden" id="codea">

                     <div  class="col-lg-3 text-line ">
                     <h3 class="lead"> Salary <br>and Disbursement<br> <span class="color-b-line"> Account </span> Details</h3>
                      </div>
                    
                          <div  class="col-lg-4 ">
                        <div class="input-group mb-2 input-n bank-err-line ">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-money"></i></span>
                          </div>
                         <select aria-label="bank" aria-describedby="basic-addon1" class="form-control " id="bank">
                            <option selected="" value="" disabled>Select Bank</option>
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
                        <div class="error-msg">
                           <span id='bank-error'></span>
                        </div>
                         <div class="input-group mb-2 input-n accountt-err-line">

                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-credit-card   "></i></span>
                          </div>
                           <select aria-label="marital" aria-describedby="basic-addon1" class="form-control " id="accounttype">
                            <option selected disabled>Account Type</option>
                            <option value="current">Current Account</option>
                            <option value="savings">Savings Account</option>
                   
                          </select>
                        </div>
                        <div class="error-msg">
                           <span id='accountt-error'></span>
                        </div>
                         <div class="input-group mb-2 input-n accountn-err-line">
                          <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card-o "></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Account Number" aria-label="bvn" aria-describedby="basic-addon1" id="accountnumber">
                        </div>
                        <div class="error-msg">
                           <span id='accountn-error'></span>
                        </div>
                        <!--  <div class="col-lg-12 col-12 checkbox">
                            <label class="container">Use a Different  <span class="col-prim">&nbsp;disbursment Account </span>
                            <input type="checkbox" name="term">
                              <span class="checkmark"></span>
                            </label>
                      </div> -->
                      
                      <div class="spinner-border text-primary text-center" role="status" id="spin-b" style="position: absolute;">
                        <span class="sr-only">Loading...</span>
                      </div>
                       <a href="#" id="btn-account" class="btn btn-fefault btn-submit ">Next</a>
                      
                      </div> 
                     </div>

                    

                  


               
              </div>
          </div>
      </div>
          <!-- end Account details -->



             <!--  Statement details -->


                  <div class="steps my-inputs" id="statement">


                   <div class="col-xs-12 col-lg-12">
                    
                       <div  class="statement-content">
                        <h1 class="text-success">You are almost done...</h1>
                        <ul class="statement success-content">
                          <li class="">
                      <img src="{{ asset('website-assets/img/success-save-png.jpg')}}" class="img img-responsive"></li>
                          <li>we have created an account for you  and a verification link has been sent to your email </li>
                        </ul>
                      </div>




                     </div>

                    

                  


               
              </div>
          </div>
      </div>
          <!-- end Account details -->


 
                    </div>
                 </form>
               </div>

  <script src="{{asset('reg-assets/js/jquery.min.js')}}"></script>
   <script src="{{asset('reg-assets/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="{{asset('reg-assets/js/scripts.js')}}"></script>
    <script src="{{asset('reg-assets/js/main.js')}}"></script>
     <script src="{{asset('reg-assets/js/lga.js')}}"></script>
</body>
</html>