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
	    

	              <form name="frm" action="{{ route('admin.viewtips') }}" method="GET">
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
		                                <button type="submit" name="btnsearch" class="btn btn-primary">Search</button>
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
			                <table id="extable" class="table table-striped dt-responsive nowrap" style="width:100%">
			                    <thead>
			                        <tr>
			                            <th> Room </th>
			                            <th> Guest </th>
			                            <th> Amount </th>
			                            <th> Tip </th>
			                            <th> Processing </th>
			                            <th> Employee Amount </th>
			                            <th> Employee </th>
			                            <th> Department </th>
			                            <th> Hotel </th>
			                            <th> Date </th>
			                        </tr>
			                    </thead>
						<tbody>
	                                @if(count($tips) > 0)
	                                    @foreach($tips as $tip)
	                                        <tr>
	                                            <td>{{ $tip->room_number }}</td>
	                                            <td>{{ $tip->last_name }}</td>
	                                            <td>${{ number_format($tip->tip_amount, 2) }}</td>
	                                            <td>${{ number_format($tip->final_amount, 2) }}</td>
	                                            <td>${{ number_format($tip->admin_commission, 2) }}</td>
	                                            <td>${{ number_format($tip->each_share, 2) }}</td>
	                                            <td>
	                                                @if($tip->employee)
	                                                    @php
	                                                        $employee_ids = explode(",", $tip->employee);
	                                                        $employees_list = \App\Models\Employee::whereIn('id', $employee_ids)->get();
	                                                    @endphp
	                                                    @foreach($employees_list as $emp)
	                                                        {{ $emp->first_name }} {{ $emp->last_name }},
	                                                    @endforeach
	                                                @else
	                                                    -
	                                                @endif
	                                            </td>
	                                            <td>{{ $tip->department }}</td>
	                                            <td>
	                                                @php
	                                                    $hotel = \App\Models\Hotel::find($tip->hotel);
	                                                @endphp
	                                                {{ $hotel ? $hotel->hotel_name : 'N/A' }}
	                                            </td>
	                                            <td>{{ $tip->date_of_tip }}</td>
	                                        </tr>
	                                    @endforeach
	                                @else
	                                    <tr><td colspan="10">No records found!</td></tr>
	                                @endif
	                            	</tbody>
			                    
			                </table>
			            </div>
			        </div>
			    </div>
	        </div>
	    
	

<x-adminfooter/>