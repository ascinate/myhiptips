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
                    <div class="auth-form-light text-center p-5" id="login">
                <div class="brand-logo">
                  HIPTIPS CORPORATE PANEL
                </div>
               
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form name="frm" action="#" method="post" class="pt-3">

                <div class="form-group">
                  <select class="form-select" name="login_type" required>
                      <option value="">--Select Login Type--</option>
                      <option value="Manager">Hotel Manager</option>
                      <option value="Office">Office/Corporate</option>
                  </select>
                </div>

                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div align="right">
                    <a href="javascript:void(0);" style="text-decoration: none; font-weight: 200; font-size: 13px; " id="switch">Forgot Password!</a>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                </form>
              </div>

              <div class="auth-form-light text-center p-5" id="forgotpass" style="display: none;">
                <div class="brand-logo"> HIPTIPS CORPORATE PANEL<br/> </div>
                <h6 class="font-weight-light">Forgot Password.</h6>
                  <h5 class="text-center" id="txt" style="color:#FF0000;"></h5>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                  </div>
                  <div class="mt-3">
                    <button type="button" id="btnpass" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                    <button type="button" id="cancel" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">CANCEL</button>
                  </div>
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
    <script type="text/javascript">
    //   $(document).ready(function(){

    //     $("#switch").click(function(){

    //       $("#login").hide();
    //       $("#forgotpass").show();

    //     });

    //     $("#cancel").click(function(){

    //       $("#login").show();
    //       $("#forgotpass").hide();
    //       location.reload();

    //     });

    //     $("#btnpass").click(function(){

    //       var email = $("#email").val();

    //       $.ajax({

    //         url: "corporate/login/forgot_pass",
    //         data: { email:email },
    //         type: "POST",
    //         success: function(data)
    //         {
    //             $("#txt").html(data);
    //             $("#email").val('');
    //         } 

    //       });

    //     });

    //   });
    </script>
</body>
</html>
