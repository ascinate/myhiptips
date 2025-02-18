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

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Earning</h4>
                        <p class="card-description"> Basic information </p>

                        <div class="col-3">
                            Total Earning:
                            @if($totalEarnings != '')
                                ${{ number_format($totalEarnings, 2) }}
                            @else
                                $0.00
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('corporate.viewcorporate', $id) }}" method="POST">
            @csrf

            <input type="hidden" name="emp_id" value="{{ $id }}">
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
                        <h4 class="card-title">Tips History</h4>

                        <table id="extable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Room No </th>
                                    <th> Guest </th>
                                    <th> Amount </th>
                                    <th> Tip </th>
                                    <th> Processing Fee </th>
                                    <th> Employee Amount </th>
                                    <th> Date </th>
                                </tr>
                            </thead>

                            <tbody>
                           
                            @if(!empty($tips))
                                @foreach($tips as $tip)
                                    <tr>
                                        <td>{{ $tip->room_number }}</td>
                                        <td>{{ $tip->last_name }}</td>
                                        <td>${{ number_format($tip->tip_amount, 2) }}</td>
                                        <td>${{ number_format($tip->final_amount, 2) }}</td>
                                        <td>${{ number_format($tip->admin_commission, 2) }}</td>
                                        <td>${{ number_format($tip->each_share, 2) }}</td>
                                        <td>{{ $tip->date_of_tip }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No records found!</td>
                                </tr>
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