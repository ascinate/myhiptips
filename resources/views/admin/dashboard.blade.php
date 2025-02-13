<x-adminheader/>
      <!-- partial -->
   <x-adminsidebar/>
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
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Tips <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">${{ number_format($sum, 2) }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Admin Commission <i class="mdi mdi-dollar mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">${{ number_format($adminCommission, 2) }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Transactions<i class="mdi mdi-dollar mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalTransactions }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Average Tip Amount <i class="mdi mdi-dollar mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">${{ number_format($averageTip, 2) }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Properties <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ number_format($totalProperties) }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Employees <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ number_format($totalEmployees) }}</h2>
                          <h2 class="mb-5"><h2>
                          <h2 class="mb-5">
                               
                        </h2>
                      </div>
                    </div>
                  </div>
                </div>

                

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Latest Users</h4>
                    <table id="extable_dashboard" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Room No</th>
                                    <th>Guest</th>
                                    <th>Tip Amount</th>
                                    <th>Processing</th>
                                    <th>Employee Amount</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Hotel Name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tips as $tip)
                                    @php
                                        $hotel = DB::table('hotel_master')->where('id', $tip->hotel)->first();
                                        $hotel_name = $hotel ? $hotel->hotel_name : 'N/A';
                                        
                                        $employees = explode(",", $tip->employee);
                                        $employeeNames = [];
                                        foreach ($employees as $emp) {
                                            $employee = DB::table('employee_master')->where('id', $emp)->first();
                                            if ($employee) {
                                                $employeeNames[] = $employee->first_name . ' ' . $employee->last_name;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $tip->room_number }}</td>
                                        <td>{{ $tip->last_name }}</td>
                                        <td>${{ number_format($tip->tip_amount, 2) }}</td>
                                        <td>${{ number_format($tip->admin_commission, 2) }}</td>
                                        <td>${{ number_format($tip->each_share, 2) }}</td>
                                        <td>{{ implode(', ', $employeeNames) ?: '-' }}</td>
                                        <td>{{ $tip->department }}</td>
                                        <td>{{ $hotel_name }}</td>
                                        <td>{{ $tip->date_of_tip }}</td>
                                    </tr>
                                @endforeach

                                @if($tips->isEmpty())
                                    <tr><td colspan="9">No records found!</td></tr>
                                @endif
                            </tbody>
                        </table>
                  </div>
                </div>
              </div>

            </div>

        </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->

<x-adminfooter/>