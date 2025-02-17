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
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <button type="button" class="btn btn-gradient-success btn-fw">Edit Employee</button>
                  </li>
                </ul>
              </nav>
        </div>
    
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Earnings</h4>
                        <p class="card-description"> Basic information </p>

                        <div class="col-3">
                            <strong>Total Earnings:</strong>
                            @if($totalEarnings)
                                ${{ number_format($totalEarnings, 2) }}
                            @else
                                $0.00
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tips History</h4>
                        <table id="extable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Room No</th>
                                    <th>Guest</th>
                                    <th>Amount</th>
                                    <th>Tip</th>
                                    <th>Admin %</th>
                                    <th>Employee Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tips as $tip)
                                    <tr>
                                        <td>{{ $tip->room_number }}</td>
                                        <td>{{ $tip->last_name }}</td>
                                        <td>${{ number_format($tip->tip_amount, 2) }}</td>
                                        <td>${{ number_format($tip->final_amount, 2) }}</td>
                                        <td>${{ number_format($tip->admin_commission, 2) }}</td>
                                        <td>${{ number_format($tip->each_share, 2) }}</td>
                                        <td>{{ $tip->date_of_tip }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No records found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-adminfooter/>
</div>   
</div>


