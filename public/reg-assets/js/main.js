

$( document ).ready(function() {


     
      $('#msg').fadeOut();
       $('#s-content').fadeOut();
        $('#invest-form').show();
        $('#success_alert').fadeOut();
        $('#error_alert').fadeOut();
		 var error = false;

		 $('#bvninput').on('keydown', function () {
		 	// if ($('#bvninput').isNumeri == false) {
		  var BvnInput  = $('#bvninput').val();
		  if ( $.isNumeric( BvnInput) === false) {
		    $('#bvn-error').text('Please provide numbers only!');
		    error = true;
		  }else if ($.isNumeric( BvnInput) ===true){
		    $('#bvn-error').text('');
		 }		
		 });



// process bvn
		  
		$('#btn-bvn').on('click', function (e) {
			 var error = false;
			 // disable the button clicked
			$('#btn-bvn').addClass("disabled");
			 $('#spin').show();


		   e.preventDefault();
		    var BvnInput  = $('#bvninput').val();
		   
		    if (BvnInput == '') {
		    	error = true;
		      $('.bvn-n').css('border' ,  '1px solid firebrick');
		      $('#bvn-error').text('Please provide your valid  bvn number to proceed!');
		       $('#btn-bvn').removeClass("disabled");
		        $('#spin').hide();
		  }else if ( $('#term').prop("checked") != true || $('#privacy').prop("checked") != true ) {
		  	 $('#btn-bvn').removeClass("disabled");
		  	  $('#spin').hide();
		  	error = true;
		     $('.bvn-n').css('border' ,  '2px solid #f2f2f2');
		     $('#bvn-error').text('');

		     $('#termp-error').text('Please, you must accept through our term and condition to proceed!');
		 
		  }else if (error ==false) {
		  	     
// prepera a request
			
			   var data = {
			    bvn: $('#bvninput').val()
			   }
			 // LOOK AT ME! BETWEEN HERE AND
			 // var token =  $('input[name="token"]').attr('value');
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           }
		           });
             

			// HERE
			 $.ajax({
			    url: "/registrations",
			    type: 'POST',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			    	 if (data.status == 200) {
	 $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
				    setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000); 

		                  // $('#coden').val(data.code);
		                  // $('#user_bvn').val(data.user_bvn);
		                  // $('#userphone').text(data.number_display);
		                  //  $('#btn-bvn').removeClass("disabled");
		                  //  $('#spin').hide();
		                  //   $('#bvnbox').hide();
		                  //   // $('#codebox').show();
		                  //    $('#personal').fadeIn();
		           $('#btn-bvn').removeClass("disabled");
                   $('#spin').hide();
                   $('#bvnbox').hide();
                    $('#codep').val(data.code);
                    $('#bvn-progress').addClass('active');
                     $('#personal-progress').addClass('active');
                    $('#bvn').fadeOut();
                    $('#personal').fadeIn();
                    
                    console.log(data.code);

			    	}else if (data.status == 404) {

                  		   
	 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
				    setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000); 
                       $('#btn-bvn').removeClass("disabled");
                        $('#spin').hide();
			    		
			    	}
                 
			       },


			     error: function (data) { 
			     		   
	 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
				    setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000); 
			    	  $('#error_text').text(data.msg);
			     	     $('#btn-bvn').removeClass("disabled");
			     	     $('#spin').hide();
                      
			    		console.log(data.status);
			    	 }
			        });

		      }});












		     // process code


		   $('#codeinput').on('keydown', function () {
		 	// if ($('#codeinput').isNumeri == false) {
		  var CodeInput  = $('#codeinput').val();
		  if ( $.isNumeric(CodeInput) === false) {
		    $('#code-error').text('Please provide numbers only!');
		    console.log(CodeInput.length);
		    error = true;
		  }else if ($.isNumeric(CodeInput) === true){
		    $('#code-error').text('');
		 }




		 if ($(this).val().length > 6 || $(this).val().length === 7 ) {
		 	  console.log(CodeInput.length);
	     $('#code-error').text('Verification code is six digit!');
		 }else if ($(this).val().length < 7 ) {
	     $('#code-error').text('');
		 }	
		 });
		  
		$('#btn-code').on('click', function (e) {

			 var error = false;
			 // disable the button clicked
			$('#btn-code').addClass("disabled");
			 $('#spin').show();


		   e.preventDefault();
		    var CodeInput  = $('#codeinput').val();
		   
		    if (CodeInput == '') {
		    	error = true;
		      $('.code-n').css('border' ,  '1px solid firebrick');
		      $('#code-error').text('Please provide your  6 digit  code  to proceed!');
		       $('#btn-code').removeClass("disabled");
		        $('#spin').hide();
		  }else if (error == false) {
		  	     
          

			
			   var data = {
			    code: $('#coden').val(),
			    inputcode:$('#codeinput').val(),
			    user_bvn:$('#user_bvn').val()
			   }
			
          // prepare a request
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           }
		           });
             
			 $.ajax({
			    url: "/registrations",
			    type: 'POST',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			    	 if (data.status == 200) {
			  
	 $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);

                  $('#btn-code').removeClass("disabled");
                   $('#spin').hide();
                    $('#codep').val(data.code);
                    $('#bvn-progress').addClass('active');
                     $('#personal-progress').addClass('active');
                    $('#bvn').fadeOut();
                    $('#personal').fadeIn();
                   
			    		console.log(data.code);

			    	}else if (data.status == 404) {
                      		   
	 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
				    setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000); 
                       $('#btn-code').removeClass("disabled");
                        $('#spin').hide();
			    		
			    	}
                 
			       },


			     error: function (data) { 
			     	 		   
	 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
				    setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000); 
			     	     $('#btn-code').removeClass("disabled");
			     	     $('#spin').hide();
                     
			    		console.log(data.status);
			    	 }
			        });

		      }});

                  



          // proccess personal detail


          	$('#btn-personal').on('click', function (e) {
             
             e.preventDefault();
			 var error = false;
			 // disable the button clicked
			$('#btn-personal').addClass("disabled");
			$('#spin-pers').show();

			  if ($('#title').val() === null) {
               // console.log(title);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();
		     $('.title-err-line').css('border' ,  '1px solid firebrick');
		     $('#title-error').text('please choose a title');
      	     
		        error = true;
		    }else if ($('#firstname').val() == '') {
               // console.log(firstname);
               // $('#firstname').hide();
               
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide(); 

		     $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid firebrick');
		     $('#firstname-error').text('provide your firstname ');
      	     
		        error = true;
		    }else  if ($('#lastname').val() == '') {
               // console.log(lastname);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();
		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid firebrick');
		     $('#lastname-error').text('provide yourincome');
      	     
		        error = true;
		    }else if ($('#email').val()== '') {
               // console.log(email);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

		     $('.email-err-line').css('border' ,  '1px solid firebrick');
		     $('#email-error').text('please choose a email');
      	     
		        error = true;
		    }else if ($('#marital').val() === null) {
               // console.log(marital);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid firebrick');
		     $('#marital-error').text('please choose a marital status');
      	     
		        error = true;
		    }else if ($('#dependent').val() === null) {
               // console.log(dependent);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();
               
              $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid firebrick');
		     $('#dependent-error').text('please choose a dependent');
      	     
		        error = true;
		    }else if ($('#education').val() === null) {
               // console.log(education);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid firebrick');
		     $('#education-error').text('please input your higher  education');
      	     
		        error = true;
		    }else   if ($('#state').val() === null) {
               // console.log(state);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		     $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid firebrick');
		     $('#state-error').text('please choose a state');
      	     
		        error = true;
		    }else   if ($('#address').val() == '') {
               // console.log(address);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

                
             $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      	     




		     $('.address-err-line').css('border' ,  '1px solid firebrick');
		     $('#address-error').text('please choose a address');
      	     
		        error = true;
		    }else if ($('#local').val() === null) {
               // console.log(local);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		     $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid firebrick');
		     $('#local-error').text('please choose a local government area');
      	     
		        error = true;
		    }else if ($('#idcard').val() == '') {
               // console.log(idcard);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid #022b69');
		     $('#local-error').text('');

		     $('.idcard-err-line').css('border' ,  '1px solid firebrick');
		     $('#idcard-error').text('please choose a idcard');
      	     
		        error = true;
		    }else if ($('#fullname').val() == '') {
               // console.log(fullname);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid #022b69');
		     $('#local-error').text('');
            
             $('.idcard-err-line').css('border' ,  '1px solid #022b69');
		     $('#idcard-error').text('');
      	     
		     $('.fullname-err-line').css('border' ,  '1px solid firebrick');
		     $('#fullname-error').text('please choose a fullname');
      	     
		        error = true;
		    }else if ($('#phone').val() == '') {
               // console.log(phone);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid #022b69');
		     $('#local-error').text('');
            
             $('.idcard-err-line').css('border' ,  '1px solid #022b69');
		     $('#idcard-error').text('');
      	       
      	     $('.fullname-err-line').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');

		     $('.phone-err-line').css('border' ,  '1px solid firebrick');
		     $('#phone-error').text('please choose a phone');
      	     
		        error = true;
		    }else if ($('#relationship').val() == '') {
               // console.log(relationship);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid #022b69');
		     $('#local-error').text('');
            
             $('.idcard-err-line').css('border' ,  '1px solid #022b69');
		     $('#idcard-error').text('');
      	       
      	     $('.fullname-err-line').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');

              $('.phone-err-line').css('border' ,  '1px solid  #022b69');
		     $('#phone-error').text('');

		     $('.relationship-err-line').css('border' ,  '1px solid firebrick');
		     $('#relationship-error').text('please choose a relationship');
      	     
		        error = true;
		    } else if ($('#kin_phone').val() == '') {
               // console.log(relationship);
		     $('#btn-personal').removeClass("disabled");
		     $('#spin-pers').hide();

		      $('.title-err-line').css('border' ,  '1px solid #022b69');
		     $('#title-error').text('');
		     $('.firstname-err-line').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');
		     $('.lastname-err-line').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');
		     $('.email-err-line').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.marital-err-line').css('border' ,  '1px solid  #022b69');
		     $('#marital-error').text('');


		     $('.dependent-err-line').css('border' ,  '1px solid #022b69');
		     $('#dependent-error').text('');

		     $('.education-err-line').css('border' ,  '1px solid #022b69');
		     $('#education-error').text('');

		     $('.state-err-line').css('border' ,  '1px solid #022b69');
		     $('#state-error').text('');
      
		     $('.address-err-line').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     $('.local-err-line').css('border' ,  '1px solid #022b69');
		     $('#local-error').text('');
            
             $('.idcard-err-line').css('border' ,  '1px solid #022b69');
		     $('#idcard-error').text('');
      	       
      	     $('.fullname-err-line').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');

              $('.phone-err-line').css('border' ,  '1px solid  #022b69');
		     $('#phone-error').text('');

		     $('.relationship-err-line').css('border' ,  '1px solid #022b69');
		     $('#relationship-error').text('');

		       $('.kinphone-err-line').css('border' ,  '1px solid firebrick');
		     $('#kinphone-error').text('please choose a kinphone');
		     
      	     
      	     
		        error = true;
		    }else{

		     error = false;


		     if (error ===false) {
                    

                       // var data = new FormData();
                       // var files = $('#idcard')[0].files;
                       //    data.append('file', files);
                       //    data.append('title', $('#title').val());
                       //    data.append('firstname', $('#firstname').val());

                       //    data.append('lastname', $('#lastname').val());
                       //    data.append('email', $('#email').val());
                       //    data.append('marital', $('#marital').val());
                       //    data.append('dependent', $('#dependent').val());
                       //    data.append('education', $('#education').val());
                       //    data.append('info', $('#info').val());
                       //    data.append('referer', $('#referer').val());
                       //    data.append('state', $('#state').val());
                       //    data.append('address', $('#address').val());
                       //    data.append('local', $('#local').val());
                       //    data.append('fullname', $('#fullname').val());
                       //    data.append('phone', $('#phone').val());
                       //    data.append('relationship', $('#relationship').val());


            //           var fd = new FormData();
				        
				        // fd.append('file',files);
                      
			   var data = {
			    title : $('#title').val(),
                  firstname : $('#firstname').val(),
                  lastname : $('#lastname').val(),
                  email  : $('#email').val(),
                  marital : $('#marital').val(),
                  dependant : $('#dependent').val(),
                  education : $('#education').val(),
                  info :  $('#info').val(),
                  referer : $('#refere').val(),
                  state : $('#state').val(),
                  address : $('#address').val(),
                  local : $('#local').val(),
                  // file: $('#idcard')[0].files,
                  fullname : $('#fullname').val(),
                  phone : $('#phone').val(),
                  kin_phone : $('#kin_phone').val(),
                  relationship : $('#relationship').val()
			   }

			   var user_code =$('#codep').val();
			
          // prepare a request
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		           }
		           });      
			 $.ajax({
			    url: "registrations/"+user_code,
			    type: 'PATCH',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			    	 if (data.status == 200) {
			 $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);

                   $('#btn-personal').removeClass("disabled");
                   $('#spin-pers').hide();
                    $('#codee').val(data.code);
                    console.log(data);
                    $('#employer-progress').addClass('active');
                    $('#personal').fadeOut();
                    $('#employer').fadeIn();
                    

			    	}else if (data.status == 404) {
                     $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
			    	   $('#btn-personal').removeClass("disabled");
                        $('#spin-pers').hide();
			    	
			    		console.log(data);
			    	}
                 
			       },


			     error: function (data) { 
			     	  $('#success_alert').hide();
			    	  	$('#error_alert').show();
			    		$('#error_text').text(data.msg);
			     	    $('#btn-personal').removeClass("disabled");
                        $('#spin-pers').hide();
                     
			    		console.log(data.status);
			    	 }
			        });

		        }
		    }
		});











                // employer details
                  	$('#btn-employer').on('click', function (e) {
             
             e.preventDefault();
			 var error = false;
			 // disable the button clicked
			$('#btn-employer').addClass("disabled");
			$('#spin-em').show();

			  if ($('#employer_name').val() == '') {
               // console.log(title);
		     $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();
		     $('.employername-err-line').css('border' ,  '1px solid firebrick');
		     $('#employername-error').text('please choose your employer name');
      	     
		        error = true;

		    }else if ($('#employer_startdate').val() == '') {
               error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid firebrick');
		     $('#employerstartdate-error').text('please choose your start date');
      	     
             }else if ($('#income').val() == '') {
               error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid firebrick');
		     $('#income-error').text('please input the net monthly income');
      	     
             }else if ($('#repayment').val() == '') {
               error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid #022b69');
		     $('#income-error').text('');

		      $('.repayment-err-line').css('border' ,  '1px solid firebrick');
		     $('#repayment-error').text('please input the net repayment');
      	     
             }else if ($('#loanamount').val() == '') {
               error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid #022b69');
		     $('#income-error').text('');

		      $('.repayment-err-line').css('border' ,  '1px solid #022b69');
		     $('#repayment-error').text('');

		      $('.loanamount-err-line').css('border' ,  '1px solid firebrick');
		     $('#loanamount-error').text('please input the loan amount');
      	     
             }
             else if ($('#loantenure').val() == null) {
                error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid #022b69');
		     $('#income-error').text('');

		      $('.repayment-err-line').css('border' ,  '1px solid #022b69');
		     $('#repayment-error').text('');

		      $('.loanamount-err-line').css('border' ,  '1px solid #022b69');
		     $('#loanamount-error').text('');
		      $('.loantenure-err-line').css('border' ,  '1px solid firebrick');
		     $('#loantenure-error').text('please input the loan tenure');
      	     
             }else if ($('#officemail').val() =='') {
               error = true;

              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid #022b69');
		     $('#income-error').text('');

		      $('.repayment-err-line').css('border' ,  '1px solid #022b69');
		     $('#repayment-error').text('');

		      $('.loanamount-err-line').css('border' ,  '1px solid #022b69');
		     $('#loanamount-error').text('');
		      $('.loantenure-err-line').css('border' ,  '1px solid #022b69');
		     $('#loantenure-error').text('');

		       $('.officemail-err-line').css('border' ,  '1px solid firebrick');
		      $('#officemail-error').text('please input your official email address');
      	     
             }

             else if ($('#empaddress').val() =='') {
               error = true;
              $('#btn-employer').removeClass("disabled");
		     $('#spin-em').hide();

		     $('.employername-err-line').css('border' ,  '1px solid #022b69');
		     $('#employername-error').text('');
      	     
		     $('.employerstartdate-err-line').css('border' ,  '1px solid #022b69');
		     $('#employerstartdate-error').text('');

		      $('.income-err-line').css('border' ,  '1px solid #022b69');
		     $('#income-error').text('');

		      $('.repayment-err-line').css('border' ,  '1px solid #022b69');
		     $('#repayment-error').text('');

		      $('.loanamount-err-line').css('border' ,  '1px solid #022b69');
		     $('#loanamount-error').text('');
		      $('.loantenure-err-line').css('border' ,  '1px solid #022b69');
		     $('#loantenure-error').text('');

		       $('.officemail-err-line').css('border' ,  '1px solid #022b69');
		      $('#officemail-error').text('');


		       $('.empaddress-err-line').css('border' ,  '1px solid firebrick');
		      $('#empaddress-error').text('please input your employer address');
      	     
              }else{
              error =false;

              if (error === false) {  

              	var data = {
			      employer_name : $('#employer_name').val(),
                  employer_startdate : $('#employer_startdate').val(),
                  income : $('#income').val(),
                  repayment  : $('#repayment').val(),
                  loanamount : $('#loanamount').val(),
                  loantenure : $('#loantenure').val(),
                  officemail: $('#officemail').val(),
                 employer_address:  $('#empaddress').val(),
                 
			   }

			   var user_code =$('#codee').val();
			
          // prepare a request
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		           }); 

			 $.ajax({
			    url: "registrations/"+user_code,
			    type: 'PUT',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			     if (data.status == 200) {
			   $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                   $('#btn-employer').removeClass("disabled");
                   $('#spin-em').hide();
                    $('#codel').val(data.code);
                    console.log(data.msg);
                    $('#loan-progress').addClass('active');
                    $('#employer').fadeOut();
                    $('#loan').fadeIn();
                  

			    	}else if (data.status == 404) {
			    	$('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                       $('#btn-employer').removeClass("disabled");
                        $('#spin-em').hide();
			    		
			    		console.log(data);
			    	}
                 
			       },


			     error: function (data) { 
			     	  $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
			     	    $('#btn-employer').removeClass("disabled");
                        $('#spin-em').hide();
                       
			    		console.log(data.status);
			    	 }
			        });

		        }
		    }
		});

     

          // loan details 




		   $('#real_loantenure').on('change', function () {
		 	// if ($('#codeinput').isNumeri == false) {
		  var loantenure  = Number($('#real_loantenure').val());
		  var principal = Number($('#real_loanamount').val());
	          if (loantenure == 1) {
                $('#interest-rate').text('pay day');
	          }else{
                  $('#interest-rate').text('Interest-Rate :: 5% per month'); }
               var perc =loantenure*5;
               var calperc = perc/100;
                var calinterest = calperc*principal;
                var interprinc = calinterest+principal;
               var repayment = Math.trunc(interprinc/loantenure);
                 

		   // if ( loantenure == 'month') {
		  	// var irate = Number(1000);
		  	//  $('#interest-rate').text('Interest-Rate ::₦'+irate);
		  	//  // var interest = (principal * $irate)/100;
		   //   var repayment = irate + principal;
		   //    console.log(repayment);
		   //  }else if (loantenure == 'year'){
		   //   	var irate = Number(3000);
		   	
		   // 	 $('#interest-rate').text('Interest-Rate ::₦'+irate);
		  	//  // var interest = (principal * $irate)/100;
		   //   var repayment = irate + principal;
		   //   console.log(repayment);
		   //  }else{
		 	 // var repayment = 0.00;
		   //  }
		   
        $('#repayround').text('₦ '+ repayment); });
                       

      $('#btn-loan').on('click', function (e) {
             
             e.preventDefault();
			 var error = false;
			 // disable the button clicked
			$('#btn-loan').addClass("disabled");
			$('#spin-l').show();

			 if ($('#real_loanamount').val() == '') {
               // console.log(title);
		     $('#btn-loan').removeClass("disabled");
		     $('#spin-l').hide();
		     $('.lamount-err-line').css('border' ,  '1px solid firebrick');
		     $('#lamount-error').text('please choose your employer name');
      	     
		        error = true;
              }else if ($('#real_loantenure').val() == null) {
                error = true;
             $('#btn-loan').removeClass("disabled");
		     $('#spin-l').hide();
		     $('.lamount-err-line').css('border' ,  '1px solid #022b69');
		     $('#lamount-error').text('');

		       $('.ltenure-err-line').css('border' ,  '1px solid firebrick');
		     $('#ltenure-error').text('please choose your employer name');
      	     
              }else{
                   
                
                if (error == false) {
                 

                 var data = {
			      real_loanamount : $('#real_loanamount').val(),
                   real_loantenure  : $('#real_loantenure').val(),
               }


			   var user_code =$('#codel').val();
			
          // prepare a request
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		           }); 

			 $.ajax({
			    url: "registrations/"+user_code,
			    type: 'PUT',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			     if (data.status == 200) {

			    $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                   $('#btn-loan').removeClass("disabled");
                   $('#spin-l').hide();
                    $('#codea').val(data.code);
                    console.log(data.msg);
                    $('#account-progress').addClass('active');
                    $('#loan').fadeOut();
                    $('#account').fadeIn();
                    

			    	}else if (data.status == 404) {
			    	$('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                       $('#btn-loan').removeClass("disabled");
                        $('#spin-l').hide();
			    		console.log(data);
			    	}
                 
			       },


			     error: function (data) { 

                     $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
			     	    $('#btn-loan').removeClass("disabled");
                        $('#spin-l').hide();
			    		console.log(data.status);
			    	 }
			        });

		        }
		    }
		});






             // bank account process



             $('#btn-account').on('click', function (e) {
             
             e.preventDefault();
			 var error = false;
			 // disable the button clicked
			$('#btn-account').addClass("disabled");
			$('#spin-b').show();

			 if ($('#bank').val() == null) {
               // console.log(title);
		     $('#btn-account').removeClass("disabled");
		     $('#spin-b').hide();
		     $('.bank-err-line').css('border' ,  '1px solid firebrick');
		     $('#bank-error').text('please provide your bank ');
      	     
		        error = true;
              }else if ($('#accounttype').val() == '') {
                error = true;
             $('#btn-account').removeClass("disabled");
		     $('#spin-b').hide();

		      $('.bank-err-line').css('border' ,  '1px solid #022b69');
		     $('#bank-error').text(' ');

		      $('.accountt-err-line').css('border' ,  '1px solid firebrick');
		     $('#accountt-error').text('please select the bank account type');

      	      } else if ($('#accountnumber').val() == '') {
                error = true;
             $('#btn-account').removeClass("disabled");
		     $('#spin-b').hide();
 
		      $('.bank-err-line').css('border' ,  '1px solid #022b69');
		     $('#bank-error').text(' ');

		      $('.accountt-err-line').css('border' ,  '1px solid #022b69');
		     $('#accountt-error').text('');

		      $('.accountn-err-line').css('border' ,  '1px solid firebrick');
		      $('#accountn-error').text('please input your bank account number');
      	     
              }else{
                   
                
                if (error == false) {
                 

                 var data = {
			      bank_name : $('#bank').val(),
                  bank_account_number  : $('#accountnumber').val(),
                  bank_account_type  : $('#accounttype').val(),
               }

                  
			   var user_code =$('#codea').val();
			
          // prepare a request
			      $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		           }); 

			 $.ajax({
			    url: "registrations/"+user_code,
			    type: 'PUT',
			    data : JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			     if (data.status == 200) {
			     $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                   $('#btn-account').removeClass("disabled");
                   $('#spin-b').hide();
                    $('#account').fadeOut();
                    $('#statement').fadeIn();
                    

			    	}else if (data.status == 404) {
			    	$('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
                       $('#btn-account').removeClass("disabled");
                        $('#spin-b').hide();
			    		console.log(data);
			    	}
                 
			       },


			     error: function (data) { 
			     $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
               setTimeout(function() {
				    $('#msg').fadeOut(); }, 3000);
			     	    $('#btn-account').removeClass("disabled");
                        $('#spin-b').hide();
                     
			    		console.log(data.status);
			    	 }
			        });

		        }
		    }
		});











// investment process

             $('#btn-invest').on('click', function (e) {
             
             e.preventDefault();

             $('#btn-invest').addClass("disabled");
			 $('#spin').show();

			 if ($('#in-firstname').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-firstname').css('border' ,  '1px solid firebrick');
		     $('#firstname-error').text('please provide your firstname');

      	     }else if ($('#in-lastname').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-lastname').css('border' ,  '1px solid firebrick');
		     $('#lastname-error').text('please provide your lastname');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

      	     }else if ($('#in-email').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-email').css('border' ,  '1px solid firebrick');
		     $('#email-error').text('please provide your email');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

      	     }else if ($('#in-phone').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-phone').css('border' ,  '1px solid firebrick');
		     $('#phone-error').text('please provide your phone');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

      	     }else if ($('#in-address').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-address').css('border' ,  '1px solid firebrick');
		     $('#address-error').text('please provide your address');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

      	     }else if ($('#in-occupation').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-occupation').css('border' ,  '1px solid firebrick');
		     $('#occupation-error').text('please provide your occupation');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

		     $('.err-line-address').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

      	     }else if ($('#in-fullname').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-fullname').css('border' ,  '1px solid firebrick');
		     $('#fullname-error').text('please provide your fullname');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

		     $('.err-line-address').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     ('.err-line-occupation').css('border' ,  '1px solid #022b69');
		     $('#occupation-error').text('');

             
             }else if ($('#kin-email').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-kin email').css('border' ,  '1px solid firebrick');
		     $('#kin email-error').text('please provide email');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

		     $('.err-line-address').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     ('.err-line-occupation').css('border' ,  '1px solid #022b69');
		     $('#occupation-error').text('');
            
            ('.err-line-fullname').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');


      	     }else if ($('#kin-phone').val() =="") {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-kin-phone').css('border' ,  '1px solid firebrick');
		     $('#kin phone-error').text('please provide phone');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

		     $('.err-line-address').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     ('.err-line-occupation').css('border' ,  '1px solid #022b69');
		     $('#occupation-error').text('');
            
            ('.err-line-fullname').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');

		     ('.err-line-kin-email').css('border' ,  '1px solid #022b69');
		     $('#kin-email-error').text('');

               }else if ($('#monthly_income').val() ===null) {
               
		     $('#btn-invest').removeClass("disabled");
		     $('#spin').hide();
		     $('.err-line-monthly-income').css('border' ,  '1px solid firebrick');
		     $('#kin monthly-income-error').text('please provide your average monthly income');


		     $('.err-line-firstname').css('border' ,  '1px solid #022b69');
		     $('#firstname-error').text('');

             $('.err-line-lastname').css('border' ,  '1px solid #022b69');
		     $('#lastname-error').text('');

             $('.err-line-email').css('border' ,  '1px solid #022b69');
		     $('#email-error').text('');

		     $('.err-line-phone').css('border' ,  '1px solid #022b69');
		     $('#phone-error').text('');

		     $('.err-line-address').css('border' ,  '1px solid #022b69');
		     $('#address-error').text('');

		     ('.err-line-occupation').css('border' ,  '1px solid #022b69');
		     $('#occupation-error').text('');
            
            ('.err-line-fullname').css('border' ,  '1px solid #022b69');
		     $('#fullname-error').text('');

		     ('.err-line-kin-email').css('border' ,  '1px solid #022b69');
		     $('#kin-email-error').text('');

		     ('.err-line-kin-phone').css('border' ,  '1px solid #022b69');
		     $('#kin-phone-error').text('');

      	     }else{

                 
      	     	  var data = {
			      firstname: $('#in-firstname').val(),
			      lastname: $('#in-lastname').val(),
			      email: $('#in-email').val(),
			      phone: $('#in-phone').val(),
			      address: $('#in-address').val(),
			      occupation: $('#in-occupation').val(),
			      fullname: $('#in-fullname').val(),
			      kinemail: $('#kin-email').val(),
			      kinphone: $('#kin-phone').val(),
			      monthly_income: $('#monthly_income').val()     }

                $.ajaxSetup({
		         headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		           }); 
     
			 $.ajax({
			    url: "registrations/create_investment",
			    type: 'POST',
			    data :JSON.stringify(data),
			    contentType : 'application/json',
			    success: function (data) {
			     if (data.status == 200) {
			       $('#btn-invest').removeClass("disabled");
		            $('#spin').hide();
		            setTimeout(function() {
	 $('#msg').fadeIn().html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
              },200);
			        
			        $('#invest-form').hide();
			         $('#s-content').fadeIn();
			         $('#email-text').html(data.data);

			    	}else if (data.status == 404) {
			    	  $('#btn-invest').removeClass("disabled");
		                $('#spin').hide();
		 setTimeout(function() {
		 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
             },500);
			    	
			    	}
                 
			       },


			     error: function (data) { 
			     	     $('#btn-invest').removeClass("disabled");
		                 $('#spin').hide();
                      setTimeout(function() {
		 $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
             },500);
			    	 }
			        });


      	     }



             });

















   });