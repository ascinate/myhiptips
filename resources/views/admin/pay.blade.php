<x-tipheader/>

<style>
  .trums-tx a{
    margin: 0 11px;
    display: inline-block;
  }
</style>

@if(request()->get('code') != '') 
    @php 
        $hotel = DB::table('hotel_master')->where('active_code', request()->get('code'))->first();
        $tips = request()->post('tip') == 'other' ? request()->post('custom_tip') : request()->post('tip');
    @endphp
@endif


<script>
    let paymentData = {
        displayItems: [
            {
                label: "Subtotal",
                type: "SUBTOTAL",
                price: "0.00",
            },
            {
                label: "Tax",
                type: "TAX",
                price: "0.00",
            }
        ],
        countryCode: "US",
        currencyCode: "USD",
        totalPriceStatus: "FINAL",
        totalPrice: "{{ $tips }}",  // Passing PHP variable to JavaScript
        totalPriceLabel: "Total"
    };

    console.log(paymentData); // Debugging
</script>


<form name="frmtip" action="{{ route('tip.payment.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="code" value="{{ request()->get('code') }}">
    <input type="hidden" name="mnRadioDefault" value="{{ request()->post('mnRadioDefault') }}">
    <input type="hidden" name="employee[]" value="{{ implode(',', request()->post('employee') ?? []) }}">
    <input type="hidden" name="room" value="{{ request()->post('room') }}">
    <input type="hidden" name="department" value="{{ request()->post('department') ?? '' }}">
    <input type="hidden" name="lname" value="{{ request()->post('lname') }}">
    <input type="hidden" name="tip" value="{{ request()->post('tip') }}">
    <input type="hidden" name="other" value="{{ request()->post('other') }}">
    <input type="hidden" name="custom_tip" value="{{ request()->post('custom_tip') }}">
    <input type="hidden" name="item_name" value="Hiptip Payment">
    <input type="hidden" name="email" value="info@experiencenxt.com"> 
    <input type="hidden" name="currency" value="USD"> 

    <div class="form-wizard">
        <fieldset>
            <header class="float-start w-100">
                <!-- Mobile View -->
                <div class="bg-fdiv01 d-block d-md-none">
                    <img src="{{ session('hotel_photo') }}" alt=""/>
                </div>

                <div class="container">
                    <div class="col-lg-9 mx-auto d-block">
                        <div class="top-headr d-inline-block w-100">
                            
                            <!-- Desktop View -->
                            <div class="bg-fdiv01 d-none d-md-block">
                                @php

                                Session::get('hotel_photo');
                                $tipData = Session::get('tip_data');

                                @endphp
                                <img src="{{ session('hotel_photo') }}" alt=""/>
                            </div>

                            <div class="row texr07 align-items-lg-center">
                                <div class="col-3 d-lg-grid justify-content-end">
                                    <div class="img-top">
                                        <h6>{{ $tipData['last_name'] }}</h6>
                                    </div>
                                </div>

                                <div class="col-9">
                                    <div class="top-next-h row">
                                        <div class="col-8">
                                            <div class="let-herd">
                                                <h1 id="dept">
                                                    {{ $tipData['employee'] }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="right-pays">
                                                <h1> 
                                                    <span class="d-none d-lg-block"> Paying </span> 
                                                    <span id="amt">
                                                        ${{ request()->post('tip') == 'other' ? request()->post('custom_tip', '0.00') : request()->post('tip', '0.00') }}
                                                    </span> 
                                                </h1>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="user-ndame-d d-flex align-items-start">
                                        <figure class="m-0">
                                            <img src="{{ asset('core/images/2815428.png') }}" alt="yuh"/>
                                        </figure>
                                        <h5> 
                                            <span id="dl"> {{ request()->post('lname', $tipData['last_name']) }}</span>
                                            <span class="d-block" id="rl"> Room No: {{ request()->post('room', $tipData['room_number']) }} </span>
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>


            <section class="body-part0 float-start w-100">
                <div class="container">
                    <div class="maind-bdo col-lg-9 mx-auto d-block">
                        <div class="topbd-head01 d-inline-block w-100">
                            <div class="d-flex align-items-center justify-content-center position-relative">
                                <a href="javascript: history.back(-1);" class="form-wizard-previous-btn btn pre-btn">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <h1 class="text-center"> Pay Using </h1>
                            </div>
                        </div>
                        <div class="tabsd-sctions d-inline-block w-100">
                            <div class="tab-content">
                                <div>
                                    <div class="d-flex align-items-center justify-content-center mt-4">
                                        <div id="container"></div>
                                    </div>
                                    <h6 class="or-txt text-center"> <span>OR</span> </h6>
                                    <div class="comon-section-forms mt-0 d-inline-block w-100">
                                        <div class="slide-d-sections d-inline-block w-100">
                                            <h2> Card Details </h2>
                                            <div class="form-floating crm-grop1">
                                                <input type="text" class="form-control wizard-required" id="name" name="name"/>
                                                <label for="roomn">Card Holder Name*</label>
                                                <span class="inp-icon">
                                                    <img src="{{ asset('core/images/usergray.svg') }}" alt="room"/>
                                                </span>
                                            </div>

                                            <div class="form-floating crm-grop1">
                                                <input type="text" class="form-control card-number wizard-required" id="card-number" name="card-number" />
                                                <label for="floatingInput">Credit /  Debit Card Number*</label>
                                                <span class="inp-icon">
                                                    <img src="{{ asset('core/images/3037255.png') }}" alt="room"/>
                                                </span>
                                                <div class="wizard-form-error"></div>
                                            </div>

                                            <h2 class="mt-4"> Expiry Date </h2>

                                            <div class="row row-cols-3 row-cols-lg-3 mt-4">
                                                <div class="col">
                                                    <div class="sepcila-form">
                                                        <label>Year*</label>
                                                        <select name="year" id="year" class="form-select card-expiry-year" aria-label="Default select example">
                                                            <option selected>Select</option>
                                                            @for ($i = 2023; $i <= 2030; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="sepcila-form">
                                                        <label>Month*</label>
                                                        <select name="month" id="month" class="form-select card-expiry-month" aria-label="Default select example">
                                                            <option selected>Select</option>
                                                            @foreach(range(1, 12) as $month)
                                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-floating crm-grop1 m-0">
                                                        <input type="password" class="form-control card-cvc wizard-required" name="cvc" id="cvc"/>
                                                        <label for="floatingInput">CVC*</label>
                                                        <div class="wizard-form-error"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="place-text01 mt-2 mt-lg-4"> You will receive payment related information here.</p>
                                            <div class="form-group ne-but-div clearfix">
                                                <button type="submit" name="btnpay" class="btn nexty-btn cbn-comon-btn"> 
                                                    <i class="fas fa-lock"></i> Confirm Pay
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </fieldset> 
    </div>
</form>



 <div class="container">
          <div class="d-flex trums-tx align-items-center justify-content-center mb-5">
              
              <a href="https://app.termly.io/document/terms-of-use-for-website/ed8d16f7-043e-4f39-8ece-88379af34b37" target="_blank" style="text-decoration: none;">Terms of use</a> | 
              <a href="https://app.termly.io/document/privacy-policy/6bf302cd-daf0-4ac5-809a-99410c385a49" target="_blank" style="text-decoration: none;">Privacy Policy</a>
          </div>
  </div>


<script type="text/javascript">

  $(document).ready(function()
  {
    $("form[name='frmtip']").validate({
    rules: {
      name: "required",
      number: "required",
      year:"required",
      month:"required",
      cvc:"required"
    },
    messages: {
      name: "Please enter your Card Nuame",
      number:"Please enter your Card Number"
      year:"Please Select Year",
      month:"Please month Year",
      cvc:"Please CVC Code"
    },
    submitHandler: function(form) {
      form.submit();
    }
   });
  });

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>



<x-tipfooter/>