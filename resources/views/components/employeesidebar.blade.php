          <!-- partial -->
          <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                @php
                    $data = DB::table('employee_master')
                ->where('id', Session::get('emp_id'))
                ->first();

                @endphp
                
               
             <img src="{{  asset('uploads/' . session('photo')) }}" alt="profile">
                   
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>

                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Employee</span>
                  <span class="text-secondary text-small">
                  {{ session('emp_first') . ' ' . session('emp_last') }}
                 </span>
                </div>

                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/employee/dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/employee/edit') }}">
                <span class="menu-title">Edit Profile</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/employee/tips') }}">
                <span class="menu-title">View Tips</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->