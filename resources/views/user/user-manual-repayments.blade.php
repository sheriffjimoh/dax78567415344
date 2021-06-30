@extends('layouts.app_header')

@section('content')
     <section id="grouped-stats" class="grouped-stats">      <!-- session message -->
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

<div class="card  " >
	<div class="card-header">
		
  <h3 class="card-title">Manual repayment</h3>
 <!--  <p>This is a means for our customer to be able deposit anytime they feel to ,<br> and this would be   deducted immidiately , from  your repayment balance.</p> -->
   <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
	</div>
	<div class="card-body offset-lg-4  col-md-4 bg-primary">
		  <form id="paymentForm">
 
    <input type="hidden" id="email-address" class="form-control" value="<?php echo Auth::user()->email ?>" />
     <div class="form-group">
    <h4 for="amount " class="text-white">Loan Repayment Balance: ₦<span id="remain">{{ (isset($repay)) ? $repay->total_repayment : 0 }}</span></h4>
  </div>
  <div class="form-group">
    <label for="amount">Enter Amount</label>
    <input type="tel" id="amount" class="form-control"  required />
  </div>
  <div  id="hide-box">
   <div class="form-group bg-white p-1" >
        <label class="text-primary" id="paying"> </label>
        <br>
         <label class="text-primary" id="repay"> </label>
    </div>
     <!-- <div class="form-group bg-white p-1" >
       
    </div> -->
  </div>
 
  <div class="form-submit">

    <?php 
    if (isset($repay->total_repayment)  &&   $repay->total_repayment == 0) {?>

    <button type="submit" class="btn btn-primary btn-block bd-white disabled" id="onclick-btn" onclick="payWithPaystack()"> Pay </button>
    <?php }else{?>
    <button type="submit" class="btn btn-primary btn-block bd-white" id="onclick-btn" disabled="" onclick="payWithPaystack()"> Pay </button>
    <?php } ?>
  </div>
</form>
<script src="https://js.paystack.co/v1/inline.js"></script> 
	</div>
</div>

<!-- // let message = 'Payment complete! Reference: ' + response.reference;
      // alert(message); -->




<script type="text/javascript">

   // remove commas 
  function removeCommas(str) {
                  while (str.search(",") >= 0) {
                      str = (str + "").replace(',', '');
                  }
                  return str;
  };


const  amount = document.getElementById("amount");
const remain =  document.getElementById("remain").innerText;
 amount.addEventListener("keyup", function(argument) {

 
 var total = Number(remain)-Number(removeCommas(amount.value));

 if (total <= 0) {
  alert('hello, you are trying to pay over your balance?')
  amount.value = ' ';
  getElementById('onclick-btn').addClassList('disabled');
 }else{
  document.getElementById("hide-box").style.display='block';
  document.getElementById("repay").innerText ='Loan Repayment Balance : ₦'+total;

  document.getElementById("paying").innerText ='You are paying: ₦'+amount.value;
 }
 });
	
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  // console.log(removeCommas(document.getElementById("amount").value))

  if (amount ==' ') {

    alert('Enter Amount');
  }else{

  let handler = PaystackPop.setup({
    key: 'pk_test_a76623a62fa4bd6b6392d75acaa39b373212a8d0', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: removeCommas(document.getElementById("amount").value) * 100,
    ref:'TS'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      if (response.status) {
      window.location.href ='/verify_payment/'+response.reference;
      }
      
    }
  });
  handler.openIframe();
}
}

</script>
</section>


@endsection














