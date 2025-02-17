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
                        <a href="{{ route('admin.corporate.add') }}" class="btn btn-gradient-success btn-fw">Add Corporate</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Corporate Logins</h4>

                        <table id="extable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Hotel </th>
                                    <th> Contact </th>
                                    <th> Email </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($corporate->isNotEmpty())
                                @php $i = 1; @endphp
                                    @foreach($corporate as $corporate)
                                        @php
                                            $hotel = DB::table('hotel_master')->where('id', $corporate->hotel_id)->first();
                                        @endphp
                                        <tr>
                                        <td><?=$i?></td>
                                        <td><?php echo $hotel->hotel_name;?></td>
                                        <td><?php echo $corporate->name;?></td>
                                        <td><?php echo $corporate->email;?></td>
                                        <td>
                                            <a href="{{ url('admin/corporate/edit/' . $corporate->id) }}">
                                            <i class="fa fa-pencil" style="font-size: 24px;"></i>
                                            </a>
                                            &nbsp; 
                                            <a href="javascript: archive({{ $corporate->id }});"><i class="fa fa-trash" style="font-size: 24px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                   @php $i++; @endphp
                                    @endforeach
                                @else
                                    <tr><td colspan="7" align="center">No records found!</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-adminfooter/>
    </div>
</div>


<script type="text/javascript">
    function archive(corporateId) {
        
        if (confirm("Are you sure you want to delete this employee?")) {
        
            window.location.href = "{{ url('admin/corporate/delete') }}/" + corporateId;
        }
    }
</script>
