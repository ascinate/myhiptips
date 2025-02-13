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
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add new hotel</h4>
                            <p class="card-description">Basic information</p>
                            
                            <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Hotel Name</label>
                                    <input type="text" name="hotel_name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Hotel Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Main Contact Name</label>
                                    <input type="text" name="contact_name" class="form-control" placeholder="Main Contact Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Additional Email</label>
                                    <input type="email" name="additional_email" class="form-control" placeholder="Additional Email">
                                </div>
                                <div class="form-group">
                                    <label>Hotel Photo</label>
                                    <input type="file" name="photo" class="form-control file-upload-info" required>
                                </div>
                                <div class="form-group">
                                    <label>Street Address</label>
                                    <input type="text" name="street" class="form-control" placeholder="Street" required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" required>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" placeholder="State" required>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" name="zipcode" class="form-control" placeholder="Zip Code" required>
                                </div>
                                <div class="form-group">
                                    <label>Activate All Staff</label>
                                    <select class="form-control" name="all_staff">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Activate Departments</label>
                                    <select class="form-control" name="is_department">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Include Commission</label>
                                    <select class="form-control" name="is_commission">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Trip Advisor Link</label>
                                    <input type="text" name="tripadvisor_link" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<x-adminfooter/>      