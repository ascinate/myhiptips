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
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                   <a href="{{ url('corporate/employees/add') }}" class="btn btn-gradient-success btn-fw">Add Employee</a>
                  </li>
                </ul>
              </nav>
            </div>





            <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Employees</h4>

                <table id="ex_emp" class="table table-striped dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Hotel name </th>
                            <th> Department </th>
                            <th> Phone </th>
                            <th> Email </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($employees->count() > 0)
                            @foreach ($employees as $employee)
                                @php
                                    $hotel = DB::table('hotel_master')->where('id', $employee->hotel_id)->first();
                                @endphp
                                <tr>
                                    <td class="py-1">
                                        @if ($employee->photo)
                                            <img src="{{ asset('uploads/' . $employee->photo) }}" alt="image" />
                                        @else
                                            <img src="{{ asset('assets/images/avatar-2.png') }}" alt="image" />
                                        @endif
                                    </td>
                                    <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                                    <td>{{ $hotel->hotel_name ?? 'N/A' }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-eye" style="font-size: 24px;"></i>
                                        </a>
                                        &nbsp;
                                        <a href="#">
                                            <i class="fa fa-pencil" style="font-size: 24px;"></i>
                                        </a>
                                        &nbsp;
                                        <a href="javascript:void(0);" onclick="archive({{ $employee->id }});">
                                            <i class="fa fa-trash" style="font-size: 24px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" align="center">No records found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-corporatefooter/>

<script type="text/javascript">
    // function archive(id) {
    //     if (confirm("Are you sure to remove?")) {
    //         window.location.href = '{{ url('corporate/employees/delete') }}/' + id;
    //     }
    // }
</script>