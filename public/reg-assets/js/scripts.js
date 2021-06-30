
const btnBvn = document.getElementById('btn-bvn');
// const btnPersonal = document.getElementById('btn-personal');
// const btnEmployer = document.getElementById('btn-employer');
// const btnLoan = document.getElementById('btn-loan');
// const btnAccount = document.getElementById('btn-account');
// const btnStatement = document.getElementById('btn-statement');
// const BvnInput = document.getElementById('bvninput').value;

  window.addEventListener('load', () => {
    document.getElementById('bvn').style.display='block';
   const bvn_progress =document.getElementById('bvn-progress');
      bvn_progress.classList.toggle('active');

  });



// bvn process
   
  //  btnBvn.addEventListener('click', (e) => {

  //  e.preventDefault();
   
  // if (document.getElementById('bvninput').value == '') {
  //     document.querySelector('.bvn-n').style.border ='1px solid firebrick';
  //     document.querySelector('#bvn-error').innerHTML = 'Please provide your  bvn number to proceed!';

  //  }else if (document.getElementById('term').checked != true || document.getElementById('privacy').checked != true){
  //     document.querySelector('#termp-error').innerHTML = 'Please, you must accept through our term and condition to proceed!';
  //  }else if ((document.getElementById('bvninput').value != '') && (document.getElementById('term').checked = true) &&  (document.getElementById('privacy').checked = true)) {
  //      document.querySelector('#bvn-error').innerHTML = '';
  //      document.querySelector('#termp-error').innerHTML = '';
  //       document.querySelector('.bvn-n').style.border ='';
  //      var  BvnInput = document.getElementById('bvninput').value;
  //     var signup_token  = document.querySelector('#signup-token').value;

  //     var xml = new XMLHttpRequest();
        
  //     var value = "bvn="+BvnInput+"token="+signup_token;
  //      xml.open("POST", "http://127.0.0.1:8000/registrations", false);
  //      xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  //      // xml.setRequestHeader("CSRF-TOKEN", signup_token);
  //      xml.setRequestHeader('X-Requested-With', 'XMLHttpRequest');


  //      xml.onload = function () {

  //       if (xml.readyState === 4) {

  //      console.log('Readystate:', xml.respondText, value);

  //       }
       
  //      }
    

  //   xml.send(value);
   
    
  // }
   // document.getElementById('bvn').style.display= 'none';
   //  document.getElementById('personal').style.display='block';
   //   const personal_progress =document.getElementById('personal-progress');
   //    personal_progress.classList.toggle('active');
   // });

   // personal process
   
   // btnPersonal.addEventListener('click', () => {
   // document.getElementById('personal').style.display= 'none';
   //  document.getElementById('employer').style.display='block';
   //   const employer_progress =document.getElementById('employer-progress');
   //    employer_progress.classList.toggle('active');
   // })


    // employer process
   
   // btnEmployer.addEventListener('click', () => {
   // document.getElementById('employer').style.display= 'none';
   //  document.getElementById('loan').style.display='block';
   //   const loan_progress =document.getElementById('loan-progress');
   //    loan_progress.classList.toggle('active');
   // })



    // loan process
   
   // btnLoan.addEventListener('click', () => {
   // document.getElementById('loan').style.display= 'none';
   //  document.getElementById('account').style.display='block';
   //   const account_progress =document.getElementById('account-progress');
   //    account_progress.classList.toggle('active');
   // })



    // account process
   
   // btnAccount.addEventListener('click', () => {
   // document.getElementById('account').style.display= 'none';
   //  document.getElementById('statement').style.display='block';
   //   const statement_progress =document.getElementById('statement-progress');
   //    statement_progress.classList.toggle('active');
   // })

   // account process
   
   // btnStatement.addEventListener('click', () => {
   // alert('done');
   // window.location.href = 'regstration.html';
   // })