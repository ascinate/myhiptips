<x-tipheader/>

<style>
  .trums-tx a
  {
    margin: 0 11px;
    display: inline-block;
  }
</style>

@if(request()->has('code') && $hotel)
    <section class="body-part0 float-start w-100">
        <div class="container">
            <div class="maind-bdo col-lg-9 mx-auto d-block">
                <div class="topbd-head01 d-inline-block w-100">
                    <h1 class="text-center">Who Would You Like To Tip?</h1>
                </div>

                <form action="{{ route('submit.tip') }}" method="POST">
                    @csrf
                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                    <div class="tabsd-sctions d-inline-block w-100">
                        <ul class="nav main-options nav-pills mb-3">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="oung-div">
                                        <div class="radio-btn01 active">
                                            <figure class="m-0">
                                                <img src="{{ asset('core/images/2815428.png') }}" alt="employee"/>
                                            </figure>
                                            <input type="radio" name="mnRadioDefault" id="hemployee" checked value="employees-ts" />
                                        </div>
                                        <label for="hemployee">Hotel Employee</label>
                                    </div>
                                </div>
                            </li>

                            @if($hotel->is_department == 'Y')
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="oung-div">
                                        <div class="radio-btn01">
                                            <figure class="m-0">
                                                <img src="{{ asset('core/images/2340823.png') }}" alt="department"/>
                                            </figure>
                                            <input type="radio" name="mnRadioDefault" id="hdepartment" value="departments-mj"/>
                                        </div>
                                        <label for="hdepartment">Hotel Department</label>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div id="employees-ts" class="show-hide show">
                                <h2>Select Employees <span class="small-iconh">(All That Apply)</span></h2>
                                <div class="emploeey-slid owl-carousel owl-theme my-4">
                                    @foreach($employees as $employee)
                                    <div class="wizard-form-radio">
                                        <div class="profil-pic">
                                            <figure class="mx-auto">
                                                @if($employee->photo)
                                                <img src="{{ asset('uploads/'.$employee->photo) }}" alt="employee"/>
                                                @else
                                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt="default"/>
                                                @endif
                                            </figure>
                                            <input type="checkbox" name="employee[]" value="{{ $employee->id }}" class="checkBoxClass"/>
                                        </div>
                                        <label>{{ ucfirst($employee->first_name) }} {{ ucfirst(substr($employee->last_name, 0, 1)) }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <h2>Select Tip Amount</h2>
                            <ul class="list-unstyled align-items-center mb-3">
                                @foreach([5, 7, 10, 12, 15] as $amount)
                                <li>
                                    <input type="radio" name="tip" class="btn-check" value="{{ $amount }}" id="option{{ $amount }}" autocomplete="off">
                                    <label class="cm-tips sp-pay btn" for="option{{ $amount }}">${{ $amount }}</label>
                                </li>
                                @endforeach
                                <li>
                                    <input type="radio" name="tip" class="btn-check" value="other" id="other-btn" autocomplete="off">
                                    <label class="cm-tips sp-pay ctext btn" for="other-btn">Custom Tip</label>
                                </li>
                            </ul>

                            <div id="custome-divam" class="custome-am">
                                <input type="text" name="custom_tip" class="form-control" id="cumtext" placeholder="Enter minimum $3"/>
                            </div>

                            <button type="submit" class="form-wizard-next-btn cbn-comon-btn">Continue to Pay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@else
    <p>Invalid hotel code.</p>
@endif

<div class="container">
      <div class="d-flex trums-tx align-items-center justify-content-center mb-5">
          <a href="https://app.termly.io/document/terms-of-use-for-website/ed8d16f7-043e-4f39-8ece-88379af34b37" target="_blank" style="text-decoration: none;">Terms of use</a> | 
          <a href="https://app.termly.io/document/privacy-policy/6bf302cd-daf0-4ac5-809a-99410c385a49" target="_blank" style="text-decoration: none;">Privacy Policy</a>
      </div>
  </div>

<!-- <script type="text/javascript">
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
 -->


<x-tipfooter/>