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
          </div>
          
          <form action="{{ route('tips.search') }}" method="POST">
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
                                      <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                          {{ $dept }}
                                      </option>
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
                            <h4 class="mt-4">Tips Summary</h4>
                              <div id="printableArea">
                                    <div class="dt-buttons"> 
                                      
                                    </div>
                                  <table width="100%"  class="table table-striped dt-responsive nowrap" id="extable5">
                                      <thead>
                                          <tr>
                                              <th>Employee</th>
                                              <th>Department</th>
                                              <th>Hotel</th>
                                              <th>Total Earnings</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($employees as $employee)
                                              <tr>
                                                  <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                  <td>{{ $employee->department }}</td>
                                                  <td>{{ $employee->hotel->hotel_name ?? 'N/A' }}</td>
                                                  <td>${{ number_format($employee->tips ? $employee->tips->sum('each_share') : 0, 2) }}</td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                        </div>
                    </div>
                  </div>
            </div>
      </div>

<x-adminfooter/>

    <script type="text/javascript">
      function printDiv(divName) 
        {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
        }
    </script>  

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
