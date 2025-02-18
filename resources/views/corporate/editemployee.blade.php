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
                        <h4 class="card-title">Edit Employee</h4>
                        <p class="card-description">Basic Information</p>

                        <form action="{{ route('employees.corpupdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                   
                           <input type="hidden" name="id" value="{{ $employee->id }}">

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $employee->email }}">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" value="{{ $employee->password }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department" required>
                                    <option value="">Select Department</option>
                                    @foreach(['Housekeeping', 'Front Desk', 'Breakfast', 'Restaurant', 'Maintenance', 'Sales', 'Banquets', 'Valet', 'Concierge', 'Laundry Attendant', 'Facility Attendant', 'Bellhop'] as $dept)
                                        <option value="{{ $dept }}" {{ $employee->department == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Profile Photo</label>
                                <input type="file" name="photo" class="form-control file-upload-info">
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button type="button" onclick="history.back();" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-corporatefooter/>
    </div>
</div>
