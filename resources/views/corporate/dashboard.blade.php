<x-corporateheader/>
      <!-- partial -->
   <x-corporatesidebar/>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                  </span> Dashboard
                </h3>
              </div>

                <div class="row">
                <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Total Tips <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">
                            {{ $sum_total ? '$' . number_format($sum_total, 2) : '0.00' }}
                        </h2>
                    </div>
                </div>
            </div>


            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Total Transaction <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">
                            {{ $total_num }}
                        </h2>
                    </div>
                </div>
            </div>

                  
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Average Tip Amount <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">
                            {{ $averageTip ? '$' . number_format($averageTip, 2) : '0.00' }}
                        </h2>
                    </div>
                </div>
            </div>

            


            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Total Employees <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">
                            {{ $totalEmployees }}
                        </h2>
                    </div>
                </div>
            </div>
              </div>

                

              <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Property URL</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('?code=' . session('code')) }}" target="_blank">
                                    {{ url('?code=' . session('code')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tips -->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Tips</h4>
                        <div class="table-responsive">
                            <table id="exwtable2" class="table table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Room No </th>
                                        <th> Guest </th>
                                        <th> Tip Amount </th>
                                        <th> Employee </th>
                                        <th> Department </th>
                                        <th> Hotel Name </th>
                                        <th> Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tips) > 0)
                                        @foreach($tips as $tip)
                                            <tr>
                                                <td>{{ $tip->room_number }}</td>
                                                <td>{{ $tip->last_name }}</td>
                                                <td>${{ number_format($tip->tip_amount, 2) }}</td>
                                                <td>
                                                    @if($tip->employee)
                                                        @php
                                                            $employeeIds = explode(",", $tip->employee);
                                                            $employees = DB::table('employee_master')
                                                                ->whereIn('id', $employeeIds)
                                                                ->get();
                                                        @endphp
                                                        @foreach($employees as $emp)
                                                            {{ $emp->first_name . ' ' . $emp->last_name }},
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $tip->department }}</td>
                                                <td>{{ $tip->hotel_name }}</td>
                                                <td>{{ $tip->date_of_tip }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="7">No records found!</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-corporatefooter/>
        </div>
     
    </div>
 

        </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->

