@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\MainController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
              <div id="msg">
      
             </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">

                       
                      New Custmers  Investment Applications
                    </h4>
                    <div class="float-right">
                      <!--   <a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right white" href="bank-add-loan.html">
                            <i class="ft-plus white"></i>Add New Loan
                        </a> -->
                    </div>
                </div>
                <div class="card-body mt-1 table-wrapper">
                    <div class="table-responsive">
                        <table   id="example1" class="table alt-pagination  loan-wrapper">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Investment ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Payment Method</th>
                                    <th class="border-top-0">Attachment</th>
                                    <th class="border-top-0">Principal (₦)</th>
                                    <th class="border-top-0">Tenor (days)</th>
                                    <th class="border-top-0">Interest Per Month (₦)</th>
                                    <th class="border-top-0">Total Interest (₦)</th>
                                    <th class="border-top-0">Rate (%)</th>
                                    <th class="border-top-0">Total (₦)(I+P)</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($data)) {

                       $total_interest = 0;
                                foreach ($data as $val) {
                            
                            $fullname =  MainController::fullname($val->user_id);

                            $total_interest = $val->interest*$val->tenure;
                           ?>
                                

                                <tr>
                                    <td>
                                        {{$val->investment_id}}
                                    </td>

                                    <td>
                                         {{$fullname}}
                                    </td>
                                     <td>
                                         {{$val->payment_method}}
                                    </td>
                                   @if($val->payment_method =='card')
                                   <td>Check Paystack Record/ Email</td>
                                     @else
                                     <td>
                                        <a href="{{ url('storage/investment_doc/'.$val->file)}}" target="_">{{$val->file}}</a>
                                       
                                    </td>
                                    @endif
                                       
                                    <td>
                                       {{number_format($val->amount,2)}}
                                    </td>
                                    <td>
                                        {{$val->tenure*30}}
                                    </td>
                                    <td>
                                        {{number_format($val->interest,2)}}
                                    </td>
                                    <td>
                                        {{number_format($total_interest,2)}}
                                    </td>
                                    <td>
                                        {{$val->rate}}
                                    </td>
                                    <td>
                                        {{number_format($val->total+$total_interest,2)}}
                                  </td>   
                                <td class="align-middle">
                                        <div class="action">
                                            <a href="#" class="btn btn-primary" id="invest-approve" 
                                            invest-id="{{$val->investment_id}}" >Mark</a>
                                          

                                           <a href="#" id="invest-reject" invest-reject-id="{{$val->investment_id}}" class="btn btn-warning" >Reject</a>
                                        </div>
                                    </td>  


                              </tr>


                               <?php } }  ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
