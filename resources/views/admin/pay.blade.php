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


<!-- <script>
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
</script> -->


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
                                    @php

                                    $hotel_id=Session::get('hotel_id');

                                    $hotelName = DB::table('hotel_master')
                                                ->where('id', $hotel_id)  
                                                ->value('hotel_name');


                                    @endphp
                                    <h6>{{ $hotelName }}</h6>
                                    </div>
                                </div>

                                <div class="col-9">
                                    <div class="top-next-h row">
                                        <div class="col-8">
                                            <div class="let-herd">
                                                <h1 id="dept">
                                                    {{ $tipData['department'] }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="right-pays">
                                                <h1> 
                                                    <span class="d-none d-lg-block"> Paying </span> 
                                                    <span id="amt">
                                                        ${{ request()->post('tip') == 'other' ? request()->post('custom_tip', '0.00') : request()->post('tip', $tipData['tip_amount']) }}
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
                                    <div id="gpay-button"></div>

                                    {{-- Pay Button 1 --}}
                                    <!-- <button class="btn comonpay-btn">
                                        <figure class="apo">
                                            <img src="{{ asset('core/images/747.png') }}" alt="pmn"/>
                                        </figure> 
                                        <span> Pay </span> 
                                    </button> -->

                                    {{-- Pay Button 2 --}}
                                    <!-- <button class="btn comonpay-btn">
                                        <figure>
                                            <img src="{{ asset('core/images/281764.png') }}" alt="pmn"/>
                                        </figure> 
                                        <span> Pay </span> 
                                    </button> -->
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

<script type="text/javascript">
/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
 */
const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};

/**
 * Card networks supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm card networks supported by your site and gateway
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "VISA"];

/**
 * Card authentication methods supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm your processor supports Android device tokens for your
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 *
 * @todo check with your gateway on the parameters to pass
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
 */
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'authorizenet',
    'gatewayMerchantId': '2530448'
  }
};

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);

/**
 * An initialized google.payments.api.PaymentsClient object or null if not yet set
 *
 * @see {@link getGooglePaymentsClient}
 */
let paymentsClient = null;

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 * @returns {object} Google Pay API version, payment methods supported by the site
 */
function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}

/**
 * Configure support for the Google Pay API
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
 * @returns {object} PaymentDataRequest fields
 */
function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    // @todo a merchant ID is available for a production environment after approval by Google
    // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
    // merchantId: '12345678901234567890',
    merchantName: 'Hip Tips Now LLC'
  };

  paymentDataRequest.callbackIntents = ["SHIPPING_ADDRESS",  "SHIPPING_OPTION", "PAYMENT_AUTHORIZATION"];
  paymentDataRequest.shippingAddressRequired = true;
  paymentDataRequest.shippingAddressParameters = getGoogleShippingAddressParameters();
  paymentDataRequest.shippingOptionRequired = true;

  return paymentDataRequest;
}

/**
 * Return an active PaymentsClient or initialize
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
 * @returns {google.payments.api.PaymentsClient} Google Pay API client
 */
function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({
      environment: "PRODUCTION",
      merchantInfo: {
        merchantName: "Hip Tips Now LLC",
        merchantId: "BCR2DN4T52A7VCKO"
      },
      paymentDataCallbacks: {
        onPaymentAuthorized: onPaymentAuthorized,
        onPaymentDataChanged: onPaymentDataChanged
      }
    });
  }
  return paymentsClient;
}


function onPaymentAuthorized(paymentData) {
        return new Promise(function(resolve, reject){

  // handle the response
  processPayment(paymentData)
    .then(function() {
      //resolve({transactionState: 'SUCCESS'});
	  window.location.href = "https://myhiptips.com/confirm";
    })
    .catch(function() {
        resolve({
        transactionState: 'ERROR',
        error: {
          intent: 'PAYMENT_AUTHORIZATION',
          message: 'Insufficient funds',
          reason: 'PAYMENT_DATA_INVALID'
        }
      });
    });

  });
}

/**
 * Handles dynamic buy flow shipping address and shipping options callback intents.
 *
 * @param {object} itermediatePaymentData response from Google Pay API a shipping address or shipping option is selected in the payment sheet.
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#IntermediatePaymentData|IntermediatePaymentData object reference}
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentDataRequestUpdate|PaymentDataRequestUpdate}
 * @returns Promise<{object}> Promise of PaymentDataRequestUpdate object to update the payment sheet.
 */
function onPaymentDataChanged(intermediatePaymentData) {
  return new Promise(function(resolve, reject) {

        let shippingAddress = intermediatePaymentData.shippingAddress;
    let shippingOptionData = intermediatePaymentData.shippingOptionData;
    let paymentDataRequestUpdate = {};

    if (intermediatePaymentData.callbackTrigger == "INITIALIZE" || intermediatePaymentData.callbackTrigger == "SHIPPING_ADDRESS") {
      if(shippingAddress.administrativeArea == "NJ")  {
        paymentDataRequestUpdate.error = getGoogleUnserviceableAddressError();
      }
      else {
        paymentDataRequestUpdate.newShippingOptionParameters = getGoogleDefaultShippingOptions();
        let selectedShippingOptionId = paymentDataRequestUpdate.newShippingOptionParameters.defaultSelectedOptionId;
        paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(selectedShippingOptionId);
      }
    }
    else if (intermediatePaymentData.callbackTrigger == "SHIPPING_OPTION") {
      paymentDataRequestUpdate.newTransactionInfo = calculateNewTransactionInfo(shippingOptionData.id);
    }

    resolve(paymentDataRequestUpdate);
  });
}

/**
 * Helper function to create a new TransactionInfo object.

 * @param string shippingOptionId respresenting the selected shipping option in the payment sheet.
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function calculateNewTransactionInfo(shippingOptionId) {
        let newTransactionInfo = getGoogleTransactionInfo();

  let shippingCost = getShippingCosts()[shippingOptionId];
  newTransactionInfo.displayItems.push({
    type: "LINE_ITEM",
    label: "Shipping cost",
    price: shippingCost,
    status: "FINAL"
  });

  let totalPrice = 0.00;
  newTransactionInfo.displayItems.forEach(displayItem => totalPrice += parseFloat(displayItem.price));
  newTransactionInfo.totalPrice = totalPrice.toString();

  return newTransactionInfo;
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
      .then(function(response) {
        if (response.result) {
          addGooglePayButton();
          // @todo prefetch payment data to improve performance after confirming site functionality
          // prefetchGooglePaymentData();
        }
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
 * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
 */
function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
      paymentsClient.createButton({
	    buttonType: 'plain',
        onClick: onGooglePaymentButtonClicked,
        allowedPaymentMethods: [baseCardPaymentMethod]
      });
  document.getElementById('container').appendChild(button);
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function getGoogleTransactionInfo() {
  return {
        /*displayItems: [
        {
          label: "Subtotal",
          type: "SUBTOTAL",
          price: "11.00",
        },
        {
          label: "Tax",
          type: "TAX",
          price: "1.00",
        }
    ],
    countryCode: 'US',
    currencyCode: "USD",
    totalPriceStatus: "FINAL",
    totalPrice: "17.00",
    totalPriceLabel: "Total"*/
    
  };
}

/**
 * Provide a key value store for shippping options.
 */
function getShippingCosts() {
        return {
    "shipping-001": "0.00",
    "shipping-002": "1.99",
    "shipping-003": "10.00"
  }
}

/**
 * Provide Google Pay API with shipping address parameters when using dynamic buy flow.
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ShippingAddressParameters|ShippingAddressParameters}
 * @returns {object} shipping address details, suitable for use as shippingAddressParameters property of PaymentDataRequest
 */
function getGoogleShippingAddressParameters() {
        return  {
        allowedCountryCodes: ['US'],
        phoneNumberRequired: true
      };
}

/**
 * Provide Google Pay API with shipping options and a default selected shipping option.
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ShippingOptionParameters|ShippingOptionParameters}
 * @returns {object} shipping option parameters, suitable for use as shippingOptionParameters property of PaymentDataRequest
 */
function getGoogleDefaultShippingOptions() {
        return {
      defaultSelectedOptionId: "shipping-001",
      shippingOptions: [
        {
          "id": "shipping-001",
          "label": "Free: Standard shipping",
          "description": "Free Shipping delivered in 5 business days."
        },
        {
          "id": "shipping-002",
          "label": "$1.99: Standard shipping",
          "description": "Standard shipping delivered in 3 business days."
        },
        {
          "id": "shipping-003",
          "label": "$10: Express shipping",
          "description": "Express shipping delivered in 1 business day."
        },
      ]
  };
}

/**
 * Provide Google Pay API with a payment data error.
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentDataError|PaymentDataError}
 * @returns {object} payment data error, suitable for use as error property of PaymentDataRequestUpdate
 */
function getGoogleUnserviceableAddressError() {
        return {
    reason: "SHIPPING_ADDRESS_UNSERVICEABLE",
    message: "Cannot ship to the selected address",
    intent: "SHIPPING_ADDRESS"
        };
}

/**
 * Prefetch payment data to improve performance
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
 */
function prefetchGooglePaymentData() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  // transactionInfo must be set but does not affect cache
  paymentDataRequest.transactionInfo = {
    totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
    currencyCode: 'USD'
  };
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.prefetchPaymentData(paymentDataRequest);
}


/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.loadPaymentData(paymentDataRequest);
}

/**
 * Process payment data returned by the Google Pay API
 *
 * @param {object} paymentData response from Google Pay API after user approves payment
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
 */
function processPayment(paymentData) {
        return new Promise(function(resolve, reject) {
        setTimeout(function() {
        // show returned data in developer console for debugging
         console.log(paymentData);
                // @todo pass payment token to your gateway to process payment
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;

        resolve({});
    }, 3000);
  });
}</script>
<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>

</script>


<script>
    function onGooglePayLoaded() {
        const paymentsClient = new google.payments.api.PaymentsClient({ environment: 'TEST' });

        const button = paymentsClient.createButton({
            buttonColor: "black",
            buttonType: "plain",
            onClick: onGooglePayButtonClicked
        });

        document.getElementById('gpay-button').appendChild(button);
    }

    function onGooglePayButtonClicked() {
        const paymentsClient = new google.payments.api.PaymentsClient({ environment: 'TEST' });

        const paymentDataRequest = {
            apiVersion: 2,
            apiVersionMinor: 0,
            allowedPaymentMethods: [{
                type: "CARD",
                parameters: {
                    allowedAuthMethods: ["PAN_ONLY", "CRYPTOGRAM_3DS"],
                    allowedCardNetworks: ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "VISA"]
                },
                tokenizationSpecification: {
                    type: "PAYMENT_GATEWAY",
                    parameters: {
                        gateway: "example",
                        gatewayMerchantId: "exampleMerchantId"
                    }
                }
            }],
            merchantInfo: {
                merchantId: "12345678901234567890",
                merchantName: "Your Business Name"
            },
            transactionInfo: {
                totalPriceStatus: "FINAL",
                totalPrice: "10.00",
                currencyCode: "USD"
            }
        };

        paymentsClient.loadPaymentData(paymentDataRequest)
            .then(function(paymentData) {
                console.log("Payment Success: ", paymentData);
            })
            .catch(function(err) {
                console.error("Payment Failed: ", err);
            });
    }
</script>



<script>
    let paymentData = @json($data);
    console.log(paymentData);
</script>

<x-tipfooter/>