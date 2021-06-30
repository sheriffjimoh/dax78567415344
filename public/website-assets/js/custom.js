jQuery(function($){'use strict';$(window).on('scroll',function(){if($(this).scrollTop()>50){$('.main-nav').addClass('menu-shrink');}else{$('.main-nav').removeClass('menu-shrink');}});jQuery('.mean-menu').meanmenu({meanScreenWidth:'991'});$('.modal a').not('.dropdown-toggle').on('click',function(){$('.modal').modal('hide');});$(function(){$('.common-btn').on('mouseenter',function(e){var parentOffset=$(this).offset(),relX=e.pageX-parentOffset.left,relY=e.pageY-parentOffset.top;$(this).find('span').css({top:relY,left:relX})}).on('mouseout',function(e){var parentOffset=$(this).offset(),relX=e.pageX-parentOffset.left,relY=e.pageY-parentOffset.top;$(this).find('span').css({top:relY,left:relX})});});$('.banner-slider').owlCarousel({items:1,loop:true,margin:0,nav:false,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,animateOut:'fadeOut',animateIn:'fadeIn',});$('.banner-slider-two').owlCarousel({items:1,loop:true,margin:0,nav:true,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,animateOut:'fadeOut',animateIn:'fadeIn',navText:["<i class='bx bx-chevron-left'></i>","<i class='bx bx-chevron-right'></i>"],});$('.popup-youtube').magnificPopup({disableOn:700,type:'iframe',mainClass:'mfp-fade',removalDelay:160,preloader:false,fixedContentPos:false});new WOW().init();$('.odometer').appear(function(e){var odo=$('.odometer');odo.each(function(){var countNumber=$(this).attr('data-count');$(this).html(countNumber);});});$('select').niceSelect();$('.team-slider').owlCarousel({loop:true,margin:0,nav:true,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,navText:["<i class='bx bx-chevron-left'></i>","<i class='bx bx-chevron-right'></i>"],responsive:{0:{items:1,},768:{items:2,},992:{items:3,}}});$('.projects-slider-three').owlCarousel({loop:true,margin:25,nav:true,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,navText:["<i class='bx bx-chevron-left'></i>","<i class='bx bx-chevron-right'></i>"],responsive:{0:{items:1,},600:{items:2,},1000:{items:3,}}});$('.logo-slider').owlCarousel({loop:true,margin:0,nav:false,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,responsive:{0:{items:1,},768:{items:4,},992:{items:5,}}});$('.accordion > li:eq(0) a').addClass('active').next().slideDown();$('.accordion a').on('click',function(j){var dropDown=$(this).closest('li').find('p');$(this).closest('.accordion').find('p').not(dropDown).slideUp();if($(this).hasClass('active')){$(this).removeClass('active');}else{$(this).closest('.accordion').find('a.active').removeClass('active');$(this).addClass('active');}
dropDown.stop(false,true).slideToggle();j.preventDefault();});$('.testimonials-slider').owlCarousel({items:1,loop:true,margin:0,nav:true,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,animateOut:'fadeOut',animateIn:'fadeIn',navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],});$('.testimonials-slider-three').owlCarousel({loop:true,margin:20,nav:true,dots:false,smartSpeed:1000,autoplay:true,autoplayTimeout:4000,autoplayHoverPause:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1,},600:{items:2,},1000:{items:3,}}});jQuery(window).on('load',function(){jQuery('.loader').fadeOut(500);});let getDaysId=document.getElementById('days');if(getDaysId!==null){const second=1000;const minute=second*60;const hour=minute*60;const day=hour*24;let countDown=new Date('October 30, 2021 00:00:00').getTime();setInterval(function(){let now=new Date().getTime();let distance=countDown-now;document.getElementById('days').innerText=Math.floor(distance/(day)),document.getElementById('hours').innerText=Math.floor((distance%(day))/(hour)),document.getElementById('minutes').innerText=Math.floor((distance%(hour))/(minute)),document.getElementById('seconds').innerText=Math.floor((distance%(minute))/second);},second);};$(function(){$(window).on('scroll',function(){var scrolled=$(window).scrollTop();if(scrolled>500)$('.go-top').addClass('active');if(scrolled<500)$('.go-top').removeClass('active');});$('.go-top').on('click',function(){$('html, body').animate({scrollTop:'0'},500);});});$('.newsletter-form').validator().on('submit',function(event){if(event.isDefaultPrevented()){formErrorSub();submitMSGSub(false,'Please enter your email correctly.');}else{event.preventDefault();}});function callbackFunction(resp){if(resp.result==='success'){formSuccessSub();}
else{formErrorSub();}}
function formSuccessSub(){$('.newsletter-form')[0].reset();submitMSGSub(true,'Thank you for subscribing!');setTimeout(function(){$('#validator-newsletter').addClass('hide');},4000)}
function formErrorSub(){$('.newsletter-form').addClass('animated shake');setTimeout(function(){$('.newsletter-form').removeClass('animated shake');},1000)}
function submitMSGSub(valid,msg){if(valid){var msgClasses='validation-success';}else{var msgClasses='validation-danger';}
$('#validator-newsletter').removeClass().addClass(msgClasses).text(msg);}
$('.newsletter-form').ajaxChimp({url:'https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9',callback:callbackFunction});}(jQuery));






              function thousands_separators(num)
            {
              var num_parts = num.toString().split(".");
              num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              return num_parts.join(".");
            }
            


             // remove seperator
             function removeCommas(str) {
                  while (str.search(",") >= 0) {
                      str = (str + "").replace(',', '');
                  }
                  return str;
              };


         

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


           
  $(document).ready( function(argument) {
          
           var tenor = Number($('#tenor').val());
            var principal =  Number(removeCommas($('#amount').val()));
         var result = calculate(principal,tenor);

     var interest_per_month = thousands_separators(result[0].toFixed(2));
     var total_interest = thousands_separators(result[0].toFixed(2)*tenor);
     var add_total_interest = result[0].toFixed(2)*tenor;
     var interprinc =add_total_interest+principal; 

     console.log(tenor);
                 
          $('#amount-display').text(thousands_separators(principal));
          $('#tenor-display').text(tenor*30);
          $('#rate').val(result[1]);
          $('#interest-display').text(thousands_separators(total_interest));
          $('#total-display').text(thousands_separators(interprinc));
  });

    

     $("#amount").on("keyup", function () {
       
              var tenor = Number($('#tenor').val());
            var principal =  Number(removeCommas($('#amount').val()));;
            if (principal > 10000000) {
        $('#amount').css('border' ,  '3px solid firebrick');
        $('#error-mode').fadeIn().html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>please reach out to Daxlinks for an investment above 10m &nbsp; <a href='/contact'>Contact Now</a></div>");
       
            }else{
           $('#amount').css('border' ,  '1px solid #ffff');
           $('#error-mode').fadeOut();
          var result = calculate(principal,tenor);

     var interest_per_month = thousands_separators(result[0].toFixed(2));
     var total_interest = thousands_separators(result[0].toFixed(2)*tenor);
     var add_total_interest = result[0].toFixed(2)*tenor;
     var interprinc =add_total_interest+principal; 

          $('#amount-display').text(thousands_separators(principal));
          $('#tenor-display').text(tenor*30);
          $('#rate').val(result[1]);
          $('#interest-display').text(thousands_separators(total_interest));
          $('#total-display').text(thousands_separators(interprinc));




      }

    });
           



     $("#tenor").on("change", function () {
       
              var tenor = Number($('#tenor').val());
            var principal = Number(removeCommas($('#amount').val()));
          var result = calculate(principal,tenor);

     var interest_per_month = thousands_separators(result[0].toFixed(2));
     var total_interest = thousands_separators(result[0].toFixed(2)*tenor);
     var add_total_interest = result[0].toFixed(2)*tenor;
     var interprinc =add_total_interest+principal; 

     console.log(tenor);
                 
          $('#amount-display').text(thousands_separators(principal));
          $('#tenor-display').text(tenor*30);
          $('#rate').val(result[1]);
          $('#interest-display').text(thousands_separators(total_interest));
          $('#total-display').text(thousands_separators(interprinc));

    });
             



            


