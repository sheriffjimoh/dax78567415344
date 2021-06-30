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
        <h3>Transaction Log</h3>
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
           <div class="table-responsive">
           <table id="example1" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Trancaction Type</th>
                        <th>Mandate ID</th>
                        <th>Date</th>
                  
                    </tr>
                </thead>
                <tbody>

                  @if(isset($transact))
                  @php $srn = 0; @endphp
                  @foreach($transact as $data)


                     @php $srn ++;

                       @endphp

                        <tr>
                          <td>{{$srn}}</td>
                          <td>
                            {{$data->transaction_id}}
                          </td>
                          <td>
                            {{$data->amount}}
                          </td>
                          <td>
                            {{$data->transaction_type}}
                          </td>
                           <td>
                            {{$data->mandate_id}}
                          </td>
                          <td>
                            {{$data->created_at}}
                          </td>
                        </tr>
                  
                     @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                          <th>#</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Trancaction Type</th>
                        <th>Mandate ID</th>
                        <th>Date</th>
                    
                    </tr>
                </tfoot>
          </table>
          </div>
          <!--/ Invoices table -->
        </div>
       </div>
     </div>

                    <!-- Invoices List table -->
</section>

</div></div></div>
<!-- Form wizard with icon tabs section end -->


@endsection