<div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Profile Section -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                @php
                    $data = DB::table('hotel_master')
                ->where('id', Session::get('cor_id'))
                ->first();

                @endphp
                    <img src="{{ asset('uploads/' . $data->photo) }}" alt="profile">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">Corporate</span>
                    <span class="text-secondary text-small">{{ $data->hotel_name }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('corporate.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item active"> 
            <a class="nav-link" href="{{ url('/corporate/dashboard/editprofile') }}"> 
                <span class="menu-title">Edit Profile</span> 
                <i class="mdi mdi-format-list-bulleted menu-icon"></i> 
            </a> 
        </li>

        <li class="nav-item"> 
        <a class="nav-link" href="{{ url('/corporate/employees') }}"> 
          <span class="menu-title">Manage Employees</span> 
          <i class="mdi mdi-contacts menu-icon"></i> 
        </a> 
      </li>

        <!-- Manage Tips -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#manageTips" aria-expanded="false" aria-controls="manageTips">
                <span class="menu-title">Manage Tips</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="manageTips">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('corporate.tips.search') }}"> View Tips </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('corporate/tips/total') }}"> View Total Earnings </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
