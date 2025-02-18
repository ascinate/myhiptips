<x-corporateheader/>
      <!-- partial -->
   <x-corporatesidebar/>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
        </div>
     

        <form name="frm" action="{{ url('/corporate/tips/search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                        <div class="col-lg-2 form-group">
                                <label>From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" required>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" required>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>Property</label>
                                <select name="hotel_id" class="form-select">
                                    <option value="">Select Property</option>
                                    @php

                                    $corId = Session::get('cor_id');

                                   $hotels = DB::table('hotel_master')
                                   ->where('id', $corId)
                                   ->get();
                                   @endphp
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                            {{ $hotel->hotel_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>Employee</label>
                                <select name="employee" class="form-select">
                                    <option value="">Select Employee</option>
                                         @php
                                        
                                        $corId = session('cor_id');  // Get the corporate ID from session

                                        $employees = DB::table('employee_master')
                                            ->where('hotel_id', $corId)
                                            ->orderBy('first_name', 'asc')
                                            ->get();
                                         @endphp
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->first_name . ' ' . $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>Department</label>
                                <select name="department" class="form-select">
                                    <option value="">Select Department</option>
                                    @foreach(['Housekeeping', 'Front Desk', 'Breakfast', 'Restaurant', 'Maintenance', 'Sales', 'Banquets', 'Valet', 'Concierge', 'Other'] as $dept)
                                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">Search</button>
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
                        <table id="exwtable" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th> Room No </th>
                                    <th> Guest </th>
                                    <th> Amount </th>
                                    <th> Tip </th>
                                    <th> Processing Cost </th>
                                   
                                </tr>
                            </thead>
                            <tbody id="pdf">
                                @forelse($tips as $tip)
                                    <tr>
                                        <td>{{ $tip->room_number }}</td>
                                        <td>{{ $tip->last_name }}</td>
                                        <td>${{ number_format($tip->tip_amount, 2) }}</td>
                                        <td>${{ number_format($tip->final_amount, 2) }}</td>
                                        <td>${{ number_format($tip->admin_commission, 2) }}</td>
                                       
                                    </tr>
                                @empty
                                    <tr><td colspan="9">No records found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-corporatefooter/>
    </div>
</div>

       
