@extends('layouts.app')

@section('content')
<div class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row justify-content-center d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
      @include('inc.message')
      
          <div class="page-body">
            <div class="row"> 
              <!-- task, page, download counter  start -->
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-c-yellow update-card">
                      <div class="card-block">
                          <div class="row align-items-end">
                              <div class="col-8">
                                <h5 class="text-white">Rs.{{$sales[0]->total}}</h5>
                                <h6 class="text-white m-b-0">Last week sales</h6>
                              </div> 
                              <div class="col-4 text-right">
                                  <canvas id="update-chart-4" height="50"></canvas>
                              </div>                             
                          </div>
                      </div>
                      <div class="card-footer">
                      <p class="text-white m-b-0"><i class="text-white f-14 m-r-10"></i>Last updated: {{$sales[0]->date}}</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-c-green update-card">
                      <div class="card-block">
                          <div class="row align-items-end">
                              <div class="col-8">
                                  <h5 class="text-white">Rs. {{$purchase[0]->total}}</h5>
                                  <h6 class="text-white m-b-0"><small>Last week purchase</small></h6>
                              </div> 
                              <div class="col-4 text-right">
                                  <canvas id="update-chart-4" height="50"></canvas>
                              </div>                             
                          </div>
                      </div>
                      <div class="card-footer">
                          <p class="text-white m-b-0"><i class="text-white f-14 m-r-10"></i>Last updated: {{$purchase[0]->date}}</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-c-pink update-card">
                      <div class="card-block">
                          <div class="row align-items-end">
                              <div class="col-8">
                                <h5 class="text-white">{{$stock[0]->total}} units</h5>
                                <h6 class="text-white m-b-0">Last week stock</h6>
                              </div>
                              <div class="col-4 text-right">
                                  <canvas id="update-chart-4" height="50"></canvas>
                              </div>                              
                          </div>
                      </div>
                      <div class="card-footer">
                          <p class="text-white m-b-0"><i class="text-white f-14 m-r-10"></i>Last updated: {{$stock[0]->date}} </p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-c-lite-green update-card">
                      <div class="card-block">
                          <div class="row align-items-end">
                              <div class="col-8">
                                <h5 class="text-white">{{$item }}<small> types</small></h5>
                                <h6 class="text-white m-b-0"><small>Total item available</small></h6>
                              </div>
                              <div class="col-4 text-right">
                                  <canvas id="update-chart-4" height="50"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                          <p class="text-white m-b-0"><i class="text-white f-14 m-r-10"> </i>Last updated: {{$purchase[0]->date}}</p>
                      </div>
                  </div>
              </div>       
        </div>     
      </div>   
    </div>
    <div ><?php
            use App\Http\Controllers\ChartController;
            ChartController::line();
          ?>  
    </div>
</div>

@endsection
