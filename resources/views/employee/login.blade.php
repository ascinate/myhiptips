<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hip Tips Admin</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            <div class="brand-logo">
                            HIPTIPS EMPLOYEE PANEL
                            </div>
                            
                            @if (session('msg'))
                                <h5 class="text-center text-danger">{{ session('msg') }}</h5>
                            @endif
                            
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            
                            <form name="frm" action="{{ route('employee.login') }}" method="POST" class="pt-3">
                                @csrf
                                
                                @if (session('msg'))
                                    <div class="alert alert-danger">
                                        {{ session('msg') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                                </div>
                                <input type="hidden" name="date_to" class="form-control" value="{{ old('date_to') }}" placeholder="To" required>

                                <input type="hidden" name="date_from" class="form-control" value="{{ old('date_from') }}" placeholder="From" required>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                                </div>
                                <div align="right">
                                    <a href="javascript:void(0);" style="text-decoration: none; font-weight: 200; font-size: 13px; " id="switch">Forgot Password!</a>
                                </div>
                                
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    
    <!-- JS Files -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
</body>
</html>
