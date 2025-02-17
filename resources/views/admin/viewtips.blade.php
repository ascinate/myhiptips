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
	                            
	                            <div class="col-lg-2 mx-2 form-group">
	                                <label>From</label>
	                                <input type="date" name="date_from" class="form-control" value="{{ old('date_from') }}" required>
	                            </div>

	                            <div class="col-lg-2 form-group">
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
	                                        <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>
	                                            {{ $dept }}
	                                        </option>
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

			                    
			                </table>
			            </div>
			        </div>
			    </div>
	        </div>
	    
	

<x-adminfooter/>