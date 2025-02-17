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
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
           
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>
                        @if (session('msg'))
                            <p class="card-description text-dark">{{ session('msg') }}</p>
                        @endif

                        <form action="{{ url('/corporate/dashboard/update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            
                            <div class="form-group">
                                <label>Hotel Name</label>
                                <input type="text" class="form-control" name="hotel_name" value="{{ $corporate->hotel_name }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact Name</label>
                                <input type="text" class="form-control" name="contact_name" value="{{ $corporate->contact_name }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ $corporate->email }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="{{ $corporate->password }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="text" class="form-control" name="phone" value="{{ $corporate->phone }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" class="form-control" name="photo">
                                @if ($corporate->photo)
                                    <img src="{{ asset('uploads/' . $corporate->photo) }}" width="110" height="110">
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Street</label>
                                <input type="text" class="form-control" name="street" value="{{ $corporate->street }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" value="{{ $corporate->city }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" class="form-control" name="state" value="{{ $corporate->state }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control" name="zipcode" value="{{ $corporate->zipcode }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Activate All Staff</label>
                                <select class="form-control" name="all_staff">
                                    <option value="Y" {{ $corporate->all_staff == 'Y' ? 'selected' : '' }}>Yes</option>
                                    <option value="N" {{ $corporate->all_staff == 'N' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Activate Departments</label>
                                <select class="form-control" name="is_department">
                                    <option value="Y" {{ $corporate->is_department == 'Y' ? 'selected' : '' }}>Yes</option>
                                    <option value="N" {{ $corporate->is_department == 'N' ? 'selected' : '' }}>No</option>
                                </select>
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
          
       
</div>
</div>

