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
                    <button type="button" class="btn btn-gradient-success btn-fw">Add Corporate</button>
                  </li>
                </ul>
              </nav>
        </div>
    
        <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Corporate</h4>
                    <p class="card-description"> Basic information </p>

                   <form name="frm" action="{{ route('admin.corporate.insert') }}" method="post">
                    @csrf
                    <div class="form-group">
                <label for="exampleInputEmail3">Hotel Name</label>
                <select class="form-control" name="hotel_id" required>
                  <option value="">--Select--</option>
                  <?php foreach($hotels as $hotel) { ?>
                    <option value="<?=$hotel->id?>">
                      <?=$hotel->hotel_name?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Contact</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Contact Name" required>
              </div>

             <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputName1" placeholder="Email" required>
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputName1" placeholder="Password" required>
              </div>

                      <button type="submit" name="btnadd" class="btn btn-gradient-primary me-2">Submit</button>
                      <button type="button" onclick="javascript: history.go(-1);" class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>

          </div>
          <x-adminfooter/>
    </div>
</div>

