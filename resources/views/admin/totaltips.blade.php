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

          <form name="frm" action="{{ route('admin.totaltips') }}" method="post">
              @csrf
              <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body d-flex align-items-center">
                              <div class="col-lg-2 form-group">
                                  <label>From</label>
                                  <input type="date" name="date_from" class="form-control" value="{{ old('date_from') }}" required>
                              </div>

                              <div class="col-lg-2 mx-2 form-group">
                                  <label>To</label>
                                  <input type="date" name="date_to" class="form-control" value="{{ old('date_to') }}" required>
                              </div>

                              <div class="col-lg-2 mx-2 form-group">
                                  <label>Property</label>
                                  <select name="hotel_id" class="form-select">
                                      <option value="">Select Property</option>
                                      @foreach($hotels as $hotel)
                                          <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
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
                                          <option value="{{ $employee->id }}" {{ old('employee') == $employee->id ? 'selected' : '' }}>
                                              {{ $employee->first_name }} {{ $employee->last_name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="col-lg-2 mx-2 form-group">
                                  <label>Department</label>
                                  <select name="department" class="form-select">
                                      <option value="">Select Department</option>
                                      @foreach(['Housekeeping', 'Front Desk', 'Breakfast', 'Restaurant', 'Maintenance', 'Sales', 'Banquets', 'Valet', 'Concierge', 'Other'] as $dept)
                                          <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
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
                          <h4 class="card-title">Tips Summary</h4>

                          <div id="printableArea">
                              <table width="100%" class="table table-striped dt-responsive nowrap" id="extable5">
                                  <thead>
                                      <tr>
                                          <th>Employee</th>
                                          <th>Department</th>
                                          <th>Hotel</th>
                                          <th>Total Earning</th>
                                      </tr>
                                  </thead>
                                  <tbody id="pdf">
                                      @foreach($employeesList as $employee)
                                          @php
                                              $sum = \App\Models\Tip::whereBetween('date_of_tip', [$from, $to])
                                                  ->whereRaw("find_in_set(?, employee)", [$employee->id])
                                                  ->sum('each_share');
                                          @endphp

                                          @if($sum > 0)
                                              <tr>
                                                  <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                  <td>{{ $employee->department }}</td>
                                                  <td>{{ optional($employee->hotel)->hotel_name }}</td>
                                                  <td>${{ number_format($sum, 2) }}</td>
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
      </div>

<x-adminfooter/>

<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>