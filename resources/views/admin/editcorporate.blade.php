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
                        <h4 class="card-title">Edit Corporate</h4>
                        <p class="card-description"> Basic information </p>

                        <form action="{{ route('admin.corporate.update') }}" method="post" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $corporate->id }}">

                            <div class="form-group">
                                <label for="hotel_id">Hotel Name</label>
                                <select class="form-control" name="hotel_id" required>
                                    <option value="">--Select--</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $hotel->id == $corporate->hotel_id ? 'selected' : '' }}>
                                            {{ $hotel->hotel_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="first_name">Contact</label>
                                <input type="text" name="name" class="form-control" value="{{ $corporate->name }}" placeholder="First Name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $corporate->email }}" placeholder="Email">
                            </div>

                         

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="{{ $corporate->password }}" placeholder="Password">
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

