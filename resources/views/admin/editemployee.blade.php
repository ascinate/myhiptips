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
            
        </div>
    
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Employee</h4>
                        <p class="card-description"> Basic information </p>

                        <form action="{{ route('admin.employees.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $employee->id }}">

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" placeholder="First Name" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" placeholder="Last Name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" placeholder="Phone">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="{{ $employee->password }}" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="hotel_id">Hotel Name</label>
                                <select class="form-control" name="hotel_id" required>
                                    <option value="">--Select--</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $hotel->id == $employee->hotel_id ? 'selected' : '' }}>
                                            {{ $hotel->hotel_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" name="department" required>
                                    <option value="Housekeeping" {{ $employee->department == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                                    <option value="Front Desk" {{ $employee->department == 'Front Desk' ? 'selected' : '' }}>Front Desk</option>
                                    <option value="Breakfast" {{ $employee->department == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                                    <option value="Restaurant" {{ $employee->department == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                                    <option value="Maintenance" {{ $employee->department == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="Sales" {{ $employee->department == 'Sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="Banquets" {{ $employee->department == 'Banquets' ? 'selected' : '' }}>Banquets</option>
                                    <option value="Valet" {{ $employee->department == 'Valet' ? 'selected' : '' }}>Valet</option>
                                    <option value="Concierge" {{ $employee->department == 'Concierge' ? 'selected' : '' }}>Concierge</option>
                                    <option value="laundry" {{ $employee->department == 'laundry' ? 'selected' : '' }}>Laundry Attendant</option>
                                    <option value="facility" {{ $employee->department == 'facility' ? 'selected' : '' }}>Facility Attendant</option>
                                    <option value="bellhop" {{ $employee->department == 'bellhop' ? 'selected' : '' }}>Bellhop</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="photo">Profile Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button type="button" onclick="history.back();" class="btn btn-light">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <x-adminfooter/>
</div>
</div>

