<script type="text/javascript">
  $(document).ready(function(){

    $("input[id^='check0']").click(function(){

        $("#spnError").hide();
    });

    $("#hemployee,#hdepartment,#astaff").click(function(){

        $("#spnError").hide();
        $("#dError").hide();
    });

    $("#a1").click(function(){

      $("#dl").html($("#lname").val());
      $("#rl").html('Room No: '+$("#roomn").val());

          $.each($("input[name='mnRadioDefault']:checked"), function(){

          var val = $(this).val();

          if(val == 'employees-ts')
          {
                var arr = [];
                var data = [];

                $.each($("input[name='employee[]']:checked"), function(){
                    arr.push($(this).next().text());
                });

                $.each($("input[name='tip']:checked"), function(){

                      //$("#amt").html('$'+$(this).val());
                        data.push($(this).val());
                });

                $("#dept").html('Employees');
                $("#emp").html(arr.join(", "));

                if(data == 'other')
                {
                  var amt = $("#cumtext").val();
                  $("#amt").html('$'+amt);
                }
                else
                {
                  $("#amt").html('$'+data.join());
                }
                
          }

          else if(val == 'departments-mj')
          {
               var sources = $("#sources").val();
               $("#dept").html(sources);
               $("#emp").html('');

               var data = [];

                $.each($("input[name='tip']:checked"), function(){
                    //$("#amt").html('$'+$(this).val());
                   data.push($(this).val());
                });

                if(data == 'other')
                {
                  var amt = $("#cumtext").val();
                  $("#amt").html('$'+amt);
                }
                else
                {
                  $("#amt").html('$'+data.join());
                }
          }

          else if(val == 'allstaff')
          {
               $("#emp").html('');

               var data = [];

                $.each($("input[name='tip']:checked"), function(){
                    //$("#amt").html('$'+$(this).val());
                   data.push($(this).val());
                });

                if(data == 'other')
                {
                  var amt = $("#cumtext").val();
                  $("#amt").html('$'+amt);
                }
                else
                {
                  $("#amt").html('$'+data.join());
                }
          }

        });

      });

  });
</script>



<style>

  label#tip-error{
    font-family: "Sora",sans-serif;
    font-size: 15px;
    color: #d70b0b;
    height: auto;
    width: 100%;
    border-radius: 0;
    border: none !important;
    position: absolute;
    /* bottom: 0; */
    font-weight: inherit;
    float: none;
    display: inline-block;
    bottom: -27px;
  }

  #employees-ts .error,
  #departments-mj #sources-error{
    font-family: "Sora",sans-serif;
    font-size: 15px;
    color: #d70b0b;
    height: auto;
    width: 100%;
    border-radius: 0;
    border: none !important;
    /* bottom: 0; */
    font-weight: inherit;
    float: none;
    display: inline-block;
  }

  #departments-mj #sources-error{
    margin-top: 14px;
  }
  #departments-mj .form-select{
    border: none;
    border-bottom: 3px solid #d8d8d8;
    border-radius: 0;
    font-weight: 600;
  }
  #departments-mj .form-select::placeholder{

  }
  .pay-tips ul{
    position: relative;
  }
  .cbn-comon-btn{
    border:none !important;
  }
  #lname-error{
    position: absolute;
    top: 55px;
    font-family: "Sora",sans-serif;
    font-size: 15px;
    color: #d70b0b;
    height: auto;
    width: 100%;
    border-radius: 0;
    border: none !important;
    /* bottom: 0; */
    font-weight: inherit;
    float: none;
    display: inline-block;
    transform: none !important;
    left: 0;
    right: 0;
    background: #d70b0b;
    height: 2px;
    padding: 0;
  }

</style>


<script type="text/javascript">

$(function() {
  $("form[name='frmtip']").validate({


    rules: {
      lname: "required",
      department:"required",
      'employee[]': {
                required: true
       },
      
    },
    tip:{
        required: true,
        radio:true,
    },
    messages: {
      lname: "",
      department:"Please select Department",
      'employee[]': {
        required: "Please select at least one Employee."
       },
    },

    errorPlacement: function(error, element) 
        {
            if ( element.is(":checkbox") ) 
            {
                error.appendTo( element.parents('#employees-ts') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },
         

    submitHandler: function(form) {
      form.submit();
    }
  });

  
});

</script>



<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="http://localhost/hiptipss/core/js/bootstrap.bundle.min.js" ></script>
<script src="http://localhost/hiptipss/core/js/custom.js" ></script>
<script src="http://localhost/hiptipss/core/js/owl.carousel.min.js"></script>

</body>
</html>