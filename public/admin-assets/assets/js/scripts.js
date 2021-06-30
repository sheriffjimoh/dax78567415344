(function(window, undefined) {
  'use strict';
 
  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

            $(window).ready(function() {
             $('#example1').DataTable();

            });

            $(window).ready(function() {
             $('#approve-form').hide();
             $('#disapprove-form').hide();
               $('#review-form').hide();
             $('#addfundform').hide();
            });

            $('#approve-btn').on('click' , function() {
              $('#approve-form').show();
               $('#disapprove-form').hide();
                  $('#review-form').hide();
               $('#contents').hide();
            });
              
            $('#disapprove-btn').on('click' , function() {
              $('#disapprove-form').show();
               $('#review-form').hide();
               $('#approve-form').hide();
               $('#contents').hide();
            });
             
              $('#review-btn').on('click' , function() {
              $('#review-form').show();
               $('#approve-form').hide();
               $('#disapprove-form').hide();
               $('#contents').hide();
            });
                $('#cancel').on('click' , function() {
              $('#review-form').hide();
               $('#approve-form').hide();
               $('#disapprove-form').hide();
               $('#contents').show();
            });


             $('#addfund').on('click' , function() {
                 $('#addfundform').show();
               $('#walletcontent').hide();
            });

               $('#cancel').on('click' , function() {
                 $('#addfundform').hide();
               $('#walletcontent').show();
            });
 

                  
           $(window).ready( function() {
              var principal =  Number($('#loan_amount').val());
              var loantenure = Number($('#loan_tenure').val());
               var perc =loantenure*5;
                         var calperc = perc/100;
                          var calinterest = calperc*principal;
                          var interprinc = calinterest+principal;
                         var repayment = Math.trunc(interprinc/loantenure);
                         $('#repayment').val(repayment);
                // console.log(repayment);
            });


            
            
           $('#loan_amount').on('keyup' , function() {
              var principal =  Number($('#loan_amount').val());
              var loantenure = Number($('#loan_tenure').val());
               var perc =loantenure*5;
                         var calperc = perc/100;
                          var calinterest = calperc*principal;
                          var interprinc = calinterest+principal;
                         var repayment = Math.trunc(interprinc/loantenure);
                         $('#repayment').val(repayment);
                // console.log(repayment);
            });


            
           $('#loan_tenure').on('keyup' , function() {
              var principal =  Number($('#loan_amount').val());
              var loantenure = Number($('#loan_tenure').val());
               var perc =loantenure*5;
                         var calperc = perc/100;
                          var calinterest = calperc*principal;
                          var interprinc = calinterest+principal;
                         var repayment = Math.trunc(interprinc/loantenure);
                         $('#repayment').val(repayment);
                // console.log(repayment);
            });
             $('#loan_tenure_r').on('keyup' , function() {
              var principal =  Number($('#loan_amount_r').val());
              var loantenure = Number($('#loan_tenure_r').val());
                  if (principal == '') {
            $('#loan_amount_r').css('border' ,  '3px solid firebrick');
            return false;
             }else{
               var perc =loantenure*5;
                         var calperc = perc/100;
                          var calinterest = calperc*principal;
                          var interprinc = calinterest+principal;
                         var repayment = Math.trunc(interprinc/loantenure);
                         $('#repayment_r').val(repayment);
                // console.log(repayment);
              }
            });

           

           $('#new_loan_tenure').on('change' , function() {
              var principal =  Number($('#new_loan_amount').val());
              var loantenure = Number($('#new_loan_tenure').val());
               if (principal == '') {
            $('#ew_loan_amount').css('border' ,  '3px solid firebrick');
            return false;
             }else{
               var perc =loantenure*5;
                         var calperc = perc/100;
                          var calinterest = calperc*principal;
                          var interprinc = calinterest+principal;
                         var repayment = Math.trunc(interprinc/loantenure);
                   
                  $('#interest-repay').show();
                $('#n_interest').text('Interest :₦'+ calinterest);

                $('#n_total_repayment').text('Total Repayment :₦'+interprinc);
          }

            });
             


             // remove commas 
             function removeCommas(str) {
                  while (str.search(",") >= 0) {
                      str = (str + "").replace(',', '');
                  }
                  return str;
              };



             $('#tenure').on('change' , function() {

              var principal = Number(removeCommas($('#amount').val()));
                 

              var tenure = Number($('#tenure').val());
             
             if (principal == '') {
              $('#amount').css('border' ,  '3px solid firebrick');
            return false;
             }else{

            $('#amount').css('border' ,  '0px solid white');
              
               var result = calculate(principal,tenure);
               if (principal > 50000000) {

                alert('something wrong please');

               }else{
                
               var interest_per_month = thousands_separators(result[0].toFixed(2));
              
               var total_interest = thousands_separators(result[0].toFixed(2)*tenure);
         
               var add_total_interest = result[0].toFixed(2)*tenure;

               var interprinc =add_total_interest+principal;    
               $('#interest-repay').show();
               $('#n_rate').text('Rate (Monthly) : %'+result[1]);
               $('#n_interest_month').text('Interest(Monthly) :  ₦'+interest_per_month);
               $('#n_interest').text('Total Interest :  ₦'+total_interest);
               $('#n_principal').text('Principal :  ₦'+thousands_separators(principal.toFixed(2)));
               $('#n_total_repayment').text('Total :  ₦'+thousands_separators(interprinc.toFixed(2)));
           
               }

              
          }

            });

               


               $("#amount").keyup(function(event){
                      // skip for arrow keys
                  if(event.which >= 37 && event.which <= 40) return;

                  // format number
                  $(this).val(function(index, value) {
                    return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
                  });


              });
            







               $('#personal_idcard').on('change' , function (argument) {
                 // alert($('#personal_idcard').val());
                 $('#display-personal_idcard').html('<span class="text-success">Path&nbsp;selected::</span>'+$('#personal_idcard').val());
               });

                $('#employer_idcard').on('change' , function (argument) {
                 // alert($('#employer_idcard').val());
                 $('#display-employer_idcard').html('<span class="text-success">Path&nbsp;selected::</span>'+$('#employer_idcard').val());
               });

               $('#bank_statement').on('change' , function (argument) {
                 // alert($('#bank_statement').val());
                 $('#display-bank_statement').html('<span class="text-success">Path&nbsp;selected::</span>'+$('#bank_statement').val());
               });


          $('#profile-pic').on('change' , function (argument) {
                 // alert($('#profile-pic').val());
                 $('#display-profile-pic').html('<span class="text-success">Path&nbsp;selected::</span>'+$('#profile-pic').val());
               });


            $('#files').on('change' , function (argument) {
                 // alert($('#profile-pic').val());
                 $('#display-files').html('<span class="text-success">Path&nbsp;selected::</span>'+$('#files').val());
               });



              function thousands_separators(num)
            {
              var num_parts = num.toString().split(".");
              num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              return num_parts.join(".");
            }



           $('#payment').on('change' , function() {
              var payment=  $('#payment').val();
             var principal =  Number(removeCommas($('#amount').val()));
              var email = $('#email').val();
              // var email = 'jimohsherifdeen6@gmail.com';

              var tenure = Number($('#tenure').val());
             
             if (principal == '') {
              $('#amount').css('border' ,  '3px solid firebrick');
             return false;
            
             }else if (tenure == ' ') {
            $('#tenure').css('border' ,  '3px solid firebrick');
             return false;
             }else{
            

             if (payment == 'transfer') {
              $('#account-details').show();
              $('#submit-handover').show();


              $('#amount').css('border' , '0px solid white');
              $('#tenure').css('border' , '0px solid white');
             
             }else if (payment =='card') {
               $('#account-details').hide();
              $('#submit-handover').hide();

              $('#amount').css('border' , '0px solid white');
              $('#tenure').css('border' , '0px solid white');
              payWithPaystack(principal,email,tenure);
             }
              
          }

            });




            function calculate(principal, tenure) {

                var result = [];
                var interest  = 0;

                
              if (principal <= 1000000 && tenure == 1) {
                   interest =  (2.5 / 100) * principal;
                   result = [interest,'2.5'];
              }else if (principal <= 1000000 && tenure == 2) {
                    interest =  (3 / 100) * principal;
                     result = [interest,'3'];
              }else if (principal <= 1000000 && tenure == 3){
                 interest =  (4 / 100) * principal;
                  result = [interest,'4'];
              }else if (principal <= 1000000 && tenure == 6){
                 interest =  (4.5 / 100) * principal;
                 result = [interest,'4.5'];
              }else if (principal <= 1000000 && tenure == 9){
                 interest =  (4.75 / 100) * principal;
                 result = [interest,'4.75'];
              }else if (principal <= 1000000 && tenure == 12){
                 interest =  (5 / 100) * principal;
                 result = [interest,'5'];



          // 1m to 5m
             }else if (principal >  1000000 && principal <= 5000000 && tenure == 1){
                 interest =  (0 / 100) * principal;
                 result = [interest,'0'];

              }else if (principal >  1000000 && principal <= 5000000 && tenure == 2){
                 interest =  (3 / 100) * principal;
                 result = [interest,'3'];

              }else if (principal >  1000000 && principal <= 5000000 && tenure == 3){
                 interest =  (3.5 / 100) * principal;
                 result = [interest,'3.5'];

              }else if (principal >  1000000 && principal <= 5000000 && tenure == 6){
                 interest =  (4 / 100) * principal;
                 result = [interest,'4'];

              }else if (principal >  1000000 && principal <= 5000000 && tenure == 9){
                 interest =  (4.5 / 100) * principal;
                 result = [interest,'4.5'];

              }else if (principal >  1000000 && principal <= 5000000 && tenure == 12){
                 interest =  (5 / 100) * principal;
                 result = [interest,'5'];


             
             // 5m to 25m
              }else if (principal >  5000000 && principal <= 25000000 && tenure == 1){
                 interest =  (0 / 100) * principal;
                 result = [interest,'0'];

              }else if (principal >  5000000 && principal <= 25000000 && tenure == 2){
                 interest =  (3.5 / 100) * principal;
                 result = [interest,'3.5'];

              }else if (principal >  5000000 && principal <= 25000000 && tenure == 3){
                 interest =  (4 / 100) * principal;
                 result = [interest,'4'];

              }else if (principal >  5000000 && principal <= 25000000 && tenure == 6){
                 interest =  (4.5 / 100) * principal;
                 result = [interest,'4.5'];

              }else if (principal >  5000000 && principal <= 25000000 && tenure == 9){
                 interest =  (4.75 / 100) * principal;
                 result = [interest,'4.75'];

              }else if (principal >  5000000 && principal <= 25000000 && tenure == 12){
                 interest =  (5 / 100) * principal;
                 result = [interest,'5'];
             
                // 25m to 50m
              }else if (principal >  25000000 && principal <= 50000000 && tenure == 1){
                 interest =  (0 / 100) * principal;
                 result = [interest,'0'];

              }else if (principal >  25000000 && principal <= 50000000 && tenure == 2){
                 interest =  (0 / 100) * principal;
                 result = [interest,'0'];

              }else if (principal >  25000000 && principal <= 50000000 && tenure == 3){
                 interest =  (4/ 100) * principal;
                 result = [interest,'4'];

              }else if (principal >  25000000 && principal <= 50000000 && tenure == 6){
                 interest =  (4.75 / 100) * principal;
                 result = [interest,'4.75'];

              }else if (principal >  25000000 && principal <= 50000000 && tenure == 9){
                 interest =  (5 / 100) * principal;
                 result = [interest,'5'];

              }else if (principal >  25000000 && principal <= 50000000 && tenure == 12){
                 interest =  (5.5 / 100) * principal;
                 result = [interest,'5.5'];
             }

             return result;
            }
















          function payWithPaystack(principal,email,tenure) {
            // e.preventDefault();
            let handler = PaystackPop.setup({
              key: 'pk_test_a76623a62fa4bd6b6392d75acaa39b373212a8d0', // Replace with your public key
              email:email,
              amount: principal * 100,
              ref:'INV'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
              // label: "Optional string that replaces customer email"
              onClose: function(){
                alert('Window closed.');
              },
              callback: function(response){
                if (response.status) {


                      var data = {
                            reference: response.reference,
                             tenure :tenure,
                         }


                      $.ajaxSetup({
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                         }); 

                 $.ajax({
                    url: "create_investment_application/",
                    type: 'POST',
                    data : JSON.stringify(data),
                    contentType : 'application/json',
                    success: function (data) {
                          if (data.status == 200) {
                  $('#msg').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                         setTimeout(function() {window.location.reload()},500);
                      }else if (data.status == 404) {
                       
                       
                           $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                     
                  }
                    },

                    error: function (data) { 

               $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                            
                       }

                  });


                }
                
              }
            });
            handler.openIframe();
              }
            






                    // investment approve

                    $(document).on('click', 'a[invest-id]', function (e) {
                        e.preventDefault();
                  // mark_investment/{key}
                        var invest_id = $(this).attr('invest-id');
                        
                   $.ajaxSetup({
                               headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                                 }); 

                         $.ajax({
                            url: "/mark_investment/"+invest_id,
                            type: 'GET',
                            contentType : 'application/json',
                            success: function (data) {
                                   if (data.status == 200) {
                          $('#msg').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                                 setTimeout(function() {window.location.reload()},500);
                              }else if (data.status == 404) {
                               
                            $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                               setTimeout(function() {window.location.reload()},500);
                             
                          }
                            },

                            error: function (data) { 

                       $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                               setTimeout(function() {window.location.reload()},500);
                               

                        }
                     
                     });

            });




                        // investment reject     // 

            $(document).on('click', 'a[invest-reject-id]', function (e) {
                e.preventDefault();

             if (confirm('are you sure you want reject this ?')) {

                var invest_id = $(this).attr('invest-reject-id');
                
           $.ajaxSetup({
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                         }); 

                 $.ajax({
                    url: "/reject_investment/"+invest_id,
                    type: 'GET',
                    contentType : 'application/json',
                    success: function (data) {
                           if (data.status == 200) {
                  $('#msg').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                         setTimeout(function() {window.location.reload()},500);
                      }else if (data.status == 404) {
                       
                    $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                     
                  }
                    },

                    error: function (data) { 

               $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                       

                }


               });

               }


               });
             






                          // investment delete     // 

            $(document).on('click', 'a[invest-delete-id]', function (e) {
                e.preventDefault();

             if (confirm('are you sure you want to delete this ?')) {

                var invest_id = $(this).attr('invest-delete-id');
                
           $.ajaxSetup({
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                         }); 

                 $.ajax({
                    url: "/delete_investment/"+invest_id,
                    type: 'GET',
                    contentType : 'application/json',
                    success: function (data) {
                           if (data.status == 200) {
                  $('#msg').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                         setTimeout(function() {window.location.reload()},500);
                      }else if (data.status == 404) {
                       
                    $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                     
                  }
                    },

                    error: function (data) { 

               $('#msg').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data.msg+"</div>");
                       setTimeout(function() {window.location.reload()},500);
                       

                }


               });

               }


               });
































})(window);