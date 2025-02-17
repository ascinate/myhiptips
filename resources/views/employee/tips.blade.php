<x-employeeheader/>
      <!-- partial -->
   <x-employeesidebar/>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
        </div>
        
        <form name="frm" action="{{ route('employee.tips') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="col-lg-2 form-group">
                                <label>To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ old('date_to') }}" required>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ old('date_from') }}" required>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" name="btnsearch" class="btn btn-primary serch-new">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tips Summary</h4>

                        <table id="exwtable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#Serial</th>
                                    <th>Room No</th>
                                    <th>Guest</th>
                                    <th>Tip</th>
                                    <th>Employee Name</th>
                                    <th>Hotel Name</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = Session::get('emp_id');
                                    $first_name = Session::get('first_name');
                                    $last_name = Session::get('last_name');
                                    $department = Session::get('department');
                                    $sum = DB::table('tips_master')
                                        ->whereRaw("FIND_IN_SET(?, employee)", [$id])
                                        ->sum('each_share');
                                    $i = 1;
                                @endphp
                                @foreach($tips as $tip)
                                    @php $hotel = DB::table('hotel_master')->where('id', $tip->hotel)->first(); @endphp
                                    <tr>
                                        <td align="center">{{ $i++ }}</td>
                                        <td>{{ $tip->room_number }}</td>
                                        <td>{{ $tip->last_name }}</td>
                                        <td>${{ number_format($tip->each_share, 2) }}</td>
                                        <td>{{ $first_name }} {{ $last_name }}</td>
                                        <td>{{ $hotel->hotel_name ?? '' }}</td>
                                        <td>{{ $department }}</td>
                                        <td>{{ $tip->date_of_tip }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="6"></th>
                                    <th>Employee Total:</th>
                                    <th>${{ number_format($sum, 2) }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-employeefooter/>    
    </div>
</div>