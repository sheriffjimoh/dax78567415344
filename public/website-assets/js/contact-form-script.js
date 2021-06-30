(function($){"use strict";

$('.common-btn').on('click', function (argument) {
       $('.common-btn').addClass('disable');
   });


	$("#contactForm").validator().on("submit",function(event){

		if(event.isDefaultPrevented()){formError();submitMSG(false,"Did you fill in the form properly?");}


		else{

			 $('.common-btn').addClass('disable');

			event.preventDefault();submitForm();

		}});

	function submitForm(){

		var name=$("#name").val();
		var email=$("#email").val();
		var msg_subject=$("#msg_subject").val();
		var phone_number=$("#phone_number").val();
		var message=$("#message").val();
		$.ajax({
			type:"POST",
			url: "/contactForm",
			data:"name="+name+"&email="+email+"&msg_subject="+msg_subject+"&phone_number="+phone_number+"&message="+message,
			   success: function (data) {
                          if (data.status == 200) {
                             $('.default-btn').removeClass('disable');
                  $('#msg').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                      
                      }else if (data.status == 404) {
                        $('.default-btn').removeClass('disabled');
                   $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       
                     
                  }
                    },

                    error: function (data) { 
                        // console.log('something went wrong');
                $('.default-btn').removeClass('disable');
               $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                     
                            
                       },

		}); }
function formSuccess(){$("#contactForm")[0].reset();submitMSG(true,"Message Submitted!")}
function formError(){$("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass();});}
function submitMSG(valid,msg){if(valid){var msgClasses="h4 tada animated text-success";}else{var msgClasses="h4 text-danger";}
$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);}}(jQuery));