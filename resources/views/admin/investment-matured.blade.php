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

                       
                      Matured Porfolio List
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
                                    <th class="border-top-0">Principal (₦)</th>
                                    <th class="border-top-0">Tenor (days)</th> 
                                    <th class="border-top-0">Rate (%)</th>
                                    <th class="border-top-0">Monthly Repayment </th>
                                    <th class="border-top-0">Interest(₦)</th>
                                    <th class="border-top-0">Total Interest(₦)</th>
                                    <th class="border-top-0">Total (₦)(I+P)</th>
                                    <th class="border-top-0">Start date</th>
                                    <th class="border-top-0">Matured date</th>

                                    
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($data)) {

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
                                       {{number_format($val->amount,2)}}
                                    </td>
                                    <td>
                                        {{$val->tenure*30}}
                                    </td>
                                    <td>
                                        {{$val->rate}}
                                    </td>
                                    
                                    <td>
                                        {{number_format($val->interest,2)}}
                                  </td>
                                  <td>   
                                        {{number_format($total_interest,2)}}
                                    </td>
                                    <td>
                                     
                                          {{number_format($val->monthly_payment,2)}}
                                    </td>
                                    <td>
                                     
                                          {{number_format($val->amount+$total_interest,2)}}
                                    </td>
                                    <td>
                                        {{ $val->start_date}}
                                  </td> 
                                  <td>
                                        {{ $val->end_date}}
                                  </td>    
                          


                                       <td>
                          <span class="dropdown">
                                <button id="btnSearchDrop28" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop28" class="dropdown-menu mt-1 dropdown-menu-right">
                                <a href="#" id="invest-reject" invest-delete-id="{{$val->investment_id}}" class="dropdown-item" ><i class="la la-trash"></i>Delete</a>
                                </span>
                            </span>
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
