@extends('layouts.app_header')

@section('content')
@php 
use App\Http\Controllers\MainController; 
@endphp
<section id="loan-details">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- session message -->
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



                <div class="card-header">
                    <h4 class="card-title float-left">

                       
                   All  Custmers 
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
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                   
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Phone </th>
                                    <th class="border-top-0">Marital Status</th> 
                                    <th class="border-top-0">Dependants</th>
                                    <th class="border-top-0">Education</th>
                                    <th class="border-top-0">Loan Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                            if (isset($data)) {
                                $srn =0;

                                foreach ($data as  $value) {
                                 
                                $reg = $value->registration ;
                               
                                $srn ++;
                           ?>
                                      <tr>
                                        <td>
                                          {{$srn}}
                                        </td>
                                         <td>
                                          {{$value->user_code}}
                                        </td>
                                        <td>
                                         <a href="/user-view/{{$value->id}}">
                                          {{ $reg['title'].' '. $value->name}}
                                        </a>
                                        </td>
                                        <td>
                                          {{$value->email}}
                                        </td>
                                        <td>
                                          {{ $reg['phone']}}
                                        </td>
                                        <td>
                                          {{ $reg['marital_status']}}
                                        </td>
                                        <td>
                                          {{ $reg['dependants']}}
                                        </td>
                                        <td>
                                          {{ $reg['education']}}
                                        </td>
                                        <td>
                                          @if($value->user_status =='approve')
                                           <span class="badge badge-success">{{$value->user_status}}</span>
                                          @endif
                                          @if($value->user_status =='new')
                                           <span class="badge badge-primary">{{$value->user_status}}</span>
                                          @endif
                                            @if($value->user_status =='paying')
                                           <span class="badge badge-info">{{$value->user_status}}</span>
                                          @endif
                                            @if($value->user_status =='rejected')
                                           <span class="badge badge-danger">{{$value->user_status}}</span>
                                          @endif
                                           @if($value->user_status =='review')
                                           <span class="badge badge-primary">{{$value->user_status.'ing'}}</span>
                                          @endif
                                          
                                        </td>

                                       <td>
                          <span class="dropdown">
                                <button id="btnSearchDrop28" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop28" class="dropdown-menu mt-1 dropdown-menu-right">
                               
                                            <a href="/deletecustomer/{{$value->id}}" class="dropdown-item" onclick="return confirm('are you sure you want to delete?')" ><i class="la la-trash danger"></i> Delete</a>
                                </span>
                            </span>
                        </td>  
                                </tr>

                               <?php  }  } ?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
