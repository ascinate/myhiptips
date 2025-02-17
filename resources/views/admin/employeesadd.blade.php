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
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <button type="button" class="btn btn-gradient-success btn-fw">Add Employee</button>
                  </li>
                </ul>
              </nav>
        </div>
    
        <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add new employee</h4>
                    <p class="card-description"> Basic information </p>

                   <form name="frm" action="{{ route('admin.employees.insert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="exampleInputName1" placeholder="First Name" required>
                      </div>

                       <div class="form-group">
                        <label for="exampleInputName1">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="exampleInputName1" placeholder="Last Name" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputName1" placeholder="Phone">
                      </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" name="email" class="form-control" id="exampleInputName1" placeholder="Email">
                      </div>

                     <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputName1" placeholder="Password">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Hotel Name</label>
                        <select class="form-control" name="hotel_id" required>
                          <option value="">--Select--</option>
                          <?php foreach($hotels as $hotel) { ?>
                            <option value="<?=$hotel->id?>"><?=$hotel->hotel_name?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword4">Department</label>
                        <select class="form-control" name="department">
                            <option value="">Select Department</option>
                                <option value="Housekeeping">Housekeeping</option>
                                <option value="Front Desk">Front Desk</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Restaurant">Restaurant</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Sales">Sales</option>
                                <option value="Banquets">Banquets</option>
                                <option value="Valet">Valet</option>
                                <option value="Concierge">Concierge</option>
                                <option value="laundry">Laundry Attendant</option>
                                <option value="facility">Facility Attendant</option>
                                <option value="bellhop">Bellhop</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Profile Photo</label>
                        <input type="file" name="photo" class="form-control file-upload-info">
                      </div>

                      <!--<div class="form-group">
                        <label for="exampleInputName1">Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" id="exampleInputName1" placeholder="Bank Name" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Routing Number</label>
                        <input type="text" name="routing_number" class="form-control" id="exampleInputName1" placeholder="Routing number" required>
                      </div>

                       <div class="form-group">
                        <label for="exampleInputName1">Account Number</label>
                        <input type="text" name="account_number" class="form-control" id="exampleInputName1" placeholder="Account number" required>
                      </div>-->

                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button type="button" onclick="javascript: history.go(-1);" class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>

          </div>
          <x-adminfooter/>
    </div>
</div>

