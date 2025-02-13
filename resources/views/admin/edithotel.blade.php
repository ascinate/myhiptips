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
                            <button type="button" class="btn btn-gradient-success btn-fw">Edit Hotel</button>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Hotel</h4>
                            <p class="card-description"> Update hotel information </p>

                            @foreach ($values as $val)
                            <form action="{{ route('hotels.update', $val->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                

                                <input type="hidden" name="id" value="POST">

                                <div class="form-group">
                                    <label>Hotel Name</label>
                                    <input type="text" name="hotel_name" class="form-control" value="{{ $val->hotel_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Hotel Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $val->phone }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Main Contact Name</label>
                                    <input type="text" name="contact_name" class="form-control" value="{{ $val->contact_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $val->email }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Password (Leave blank to keep current)</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Additional Email</label>
                                    <input type="email" name="additional_email" class="form-control" value="{{ $val->additional_email }}">
                                </div>

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                    @if($val->photo)
                                        <img src="{{ asset('uploads/'.$val->photo) }}" width="110" height="110">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Street Address</label>
                                    <input type="text" name="street" class="form-control" value="{{ $val->street }}" required>
                                </div>

                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $val->city }}" required>
                                </div>

                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="{{ $val->state }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" name="zipcode" class="form-control" value="{{ $val->zipcode }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Activate All Staff</label>
                                    <select class="form-control" name="all_staff">
                                        <option value="Y" {{ $val->all_staff == 'Y' ? 'selected' : '' }}>Yes</option>
                                        <option value="N" {{ $val->all_staff == 'N' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Activate Departments</label>
                                    <select class="form-control" name="is_department">
                                        <option value="Y" {{ $val->is_department == 'Y' ? 'selected' : '' }}>Yes</option>
                                        <option value="N" {{ $val->is_department == 'N' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Include Commission</label>
                                    <select class="form-control" name="is_commission">
                                        <option value="Y" {{ $val->is_commission == 'Y' ? 'selected' : '' }}>Yes</option>
                                        <option value="N" {{ $val->is_commission == 'N' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Trip Advisor Link</label>
                                    <input type="text" name="tripadvisor_link" class="form-control" value="{{ $val->tripadvisor_link }}">
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-light">Cancel</button>
                            </form>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<x-adminfooter/>      