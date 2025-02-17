<x-employeeheader/>
      <!-- partial -->
   <x-employeesidebar/>
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
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Tips <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                        <h2 class="mb-5">
                            @php
                                $id = session('emp_id');
                                $sum = DB::table('tips_master')
                                    ->whereRaw("find_in_set(?, employee)", [$id])
                                    ->sum('each_share');
                            @endphp
                            {{ $sum ? '$' . number_format($sum, 2) : '0.00' }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Number of Tips <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                        <h2 class="mb-5">
                            @php
                                $numrows = DB::table('tips_master')
                                    ->whereRaw("find_in_set(?, employee)", [$id])
                                    ->count();
                            @endphp
                            {{ $numrows }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Properties <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                        <h2 class="mb-5">1</h2>
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
                            <table id="exwtable2" class="table">
                                <thead>
                                    <tr>
                                        <th> Room No </th>
                                        <th> Guest </th>
                                        <th> Tip Amount </th>
                                        <th> Hotel Name </th>
                                        <th> Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($tips->count() > 0)
                                        @foreach($tips as $tip)
                                            @php
                                                $hotel = DB::table('hotel_master')->where('id', $tip->hotel)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $tip->room_number }}</td>
                                                <td>{{ $tip->last_name }}</td>
                                                <td>{{ '$' . number_format($tip->each_share, 2) }}</td>
                                                <td>{{ $hotel->hotel_name ?? 'N/A' }}</td>
                                                <td>{{ $tip->date_of_tip }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="6">No records found!</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-employeefooter/>

    </div>
 

</div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->

