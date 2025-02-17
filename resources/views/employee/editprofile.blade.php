<x-employeeheader/>
<!-- partial -->
<x-employeesidebar/>
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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>
                        @if (session('msg'))
                            <p class="card-description text-dark">{{ session('msg') }}</p>
                        @endif

                        <form action="{{ url('employee/update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}" >
                            </div>
                            
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ $employee->email }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="{{ $employee->password }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}">
                            </div>
                            
                            
                            
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button type="button" class="btn btn-light" onclick="history.go(-1);">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
            
          </div>
          <!-- content-wrapper ends -->
          
          <x-employeefooter/> 
</div>
</div>

