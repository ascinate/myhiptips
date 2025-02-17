<div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Profile Section -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">Administrator</span>
                    <span class="text-secondary text-small">Control Panel</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- Manage Modules -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#manageModules" aria-expanded="false" aria-controls="manageModules">
                <span class="menu-title">Manage Modules</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="manageModules">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.hotel') }}"> Manage Hotels </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.employees') }}"> Manage Employees </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.corporate') }}"> Manage Corporate Login </a></li>
                </ul>
            </div>
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
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.viewtips') }}"> View Tips </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.totaltips') }}"> View Total Earnings </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
