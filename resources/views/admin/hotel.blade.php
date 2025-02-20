<x-adminheader/>
      <!-- partial -->
   <x-adminsidebar/>

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
                            <a href="{{ route('hotels.create') }}" class="btn btn-gradient-success btn-fw">Add Hotel</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Hotels</h4>
                            <table id="extable2" class="table table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Photo </th>
                                        <th> Hotel </th>
                                        <th> Contact </th>
                                        <th> Email </th>
                                        <th> Phone </th>
                                        <th> Postcode </th>
                                        <th> Action </th>
                                        <th> URL </th>
                                        <th> Tripadvisor Link </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($hotels) > 0)
                                        @foreach($hotels as $hotel)
                                            <tr>
                                                <td class="py-1">
                                                    <img src="{{ asset('uploads/'.$hotel->photo) }}" alt="image" />
                                                </td>
                                                <td>{{ $hotel->hotel_name }}</td>
                                                <td>{{ $hotel->contact_name }}</td>
                                                <td>{{ $hotel->email }}</td>
                                                <td>{{ $hotel->phone }}</td>
                                                <td>{{ $hotel->zipcode }}</td>
                                                <td>
                                                    <a href="{{ route('hotels.show', $hotel->id) }}" title="Details">
                                                        <i class="fa fa-eye" style="font-size: 24px;"></i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="{{ route('hotels.edit', $hotel->id) }}">
                                                        <i class="fa fa-pencil" style="font-size: 24px;"></i>
                                                    </a>
                                                    &nbsp; 
                                                    <a href="javascript:void(0);" onclick="archive({{ $hotel->id }});">
                                                        <i class="fa fa-trash" style="font-size: 24px;"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/?code='.$hotel->active_code) }}" 
                                                    target="_blank" 
                                                    id="hotel-link-{{ $hotel->id }}" 
                                                    onclick="storeHotelIdInSession({{ $hotel->id }})">
                                                        {{ url('/?code='.$hotel->active_code) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ $hotel->tripadvisor_link }}" target="_blank">
                                                        {{ $hotel->tripadvisor_link }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" align="center">No records found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function storeHotelIdInSession(hotelId) {
            // Store the hotel ID in session (use AJAX for this)
            // You will need a route in your web.php to handle storing the session value

            fetch('{{ route('storeHotelSession') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF token for security
                },
                body: JSON.stringify({ hotel_id: hotelId })
            })
            .then(response => response.json())
            .then(data => {
                
                window.open('{{ url('/?code='.$hotel->active_code) }}', '_blank');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    

    <!-- JavaScript for Delete Confirmation -->
    <script type="text/javascript">
        function archive(id) {
            if (confirm("Are you sure to remove?")) {
                window.location.href = '{{ url("admin/hotels/delete/") }}/' + id;
            }
        }
    </script>

<x-adminfooter/>    