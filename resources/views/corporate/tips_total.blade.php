<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

$to = request('date_to');
$from = request('date_from');
$hotelid = Session::get('cor_id');
$employeeid = request('employee');
$department = request('department');
$hotels = DB::table('hotel_master')
        ->where('id', $hotelid)
        ->get();
$employees = DB::table('employee_master')
    ->where('hotel_id', $hotelid)
    ->where('is_archive', 'N')
    ->orderBy('first_name')
    ->get();
?>

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

        <form name="frm" action="{{ url('/corporate/tips/total') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="col-lg-2 form-group">
                                <label>To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" required>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" required>
                            </div>
                            <div class="col-lg-2 mx-2 form-group">
                                <label>Property</label>
                                <select name="hotel_id" class="form-select">
                                    <option value="">Select Property</option>
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
                        <h4 class="card-title">Total Earning</h4>
                        <div id="printableArea">
                            <table width="100%" class="table table-striped dt-responsive nowrap" id="exwtable3">
                                <thead>
                                    <tr>
                                        <th> Employee </th>
                                        <th> Department </th>
                                        <th> Hotel </th>
                                        <th> Total Earning </th>
                                    </tr>
                                </thead>
                                <tbody id="pdf">
                                    @php
                                        $query = DB::table('employee_master')->where('hotel_id', $hotelid)->where('is_archive', 'N');
                                        if ($department) $query->where('department', $department);
                                        if ($employeeid) $query->where('id', $employeeid);
                                        $employees = $query->get();
                                    @endphp

                                    @foreach($employees as $val)
                                        @php
                                            $sumQuery = DB::table('tips_master')
                                                ->whereRaw("FIND_IN_SET(?, employee)", [$val->id]);
                                            if ($to && $from) {
                                                $sumQuery->whereBetween('date_of_tip', [$to, $from]);
                                            }
                                            $sum = $sumQuery->sum('each_share');
                                            $hotel_name = DB::table('hotel_master')->where('id', $val->hotel_id)->value('hotel_name');
                                        @endphp
                                        @if($sum > 0)
                                            <tr>
                                                <td> {{ $val->first_name . ' ' . $val->last_name }} </td>
                                                <td> {{ $val->department }} </td>
                                                <td> {{ $hotel_name }} </td>
                                                <td> ${{ number_format($sum, 2) }} </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-corporatefooter/>
    </div>
</div>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
