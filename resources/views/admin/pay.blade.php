<x-tipheader/>

<style>
  .tabsd-sctions iframe .form__input{
    border: none;
    border-bottom: 3px solid #d8d8d8;
	  width: 100%;
   }
</style>

<form name="frm" action="" method="post">
  <fieldset class="wizard-fieldset">
    <header class="float-start w-100">
      <div class="bg-fdiv01 d-block d-md-none">
        <img src="{{ asset('uploads/' . $hotel->photo) }}" alt=""/>
      </div>
      <div class="container">
        <div class="col-lg-9 mx-auto d-block">
          <div class="top-headr d-inline-block w-100">
            <div class="bg-fdiv01 d-none d-md-block">
              <img src="{{ asset('uploads/' . $hotel->photo) }}" alt=""/>
            </div>
            <div class="row texr07 align-items-lg-center">
              <div class="col-3 d-lg-grid justify-content-end">
                <div class="img-top">
                  <h6>{{ $hotel->hotel_name }}</h6>
                </div>
              </div>
              <div class="col-9">
                <div class="top-next-h row">
                  <div class="col-8">
                    <div class="let-herd">
                      <h1 id="dept"> Employees </h1>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="right-pays">
                      <h1> <span class="d-none d-lg-block"> Paying </span> <span id="amt"> ${{ $total }} </span> </h1>
                    </div>
                  </div>
                </div>
                <div class="user-ndame-d d-flex align-items-start">
                  <figure class="m-0">
                    <img src="{{ asset('core/images/2815428.png') }}" alt="yuh"/>
                  </figure>
                  <h5> 
                    <span id="dl"> {{ $sessionData['lname'] }} </span>
                    <span class="d-block" id="rl"> Room No: {{ $sessionData['room_number'] }} </span>
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
              <a href="javascript:history.go(-1)" class="form-wizard-previous-btn btn pre-btn">
                <i class="fas fa-arrow-left"></i>
              </a>
              <h1 class="text-center"> Pay Using </h1>
            </div>
          </div>
          <div class="tabsd-sctions d-inline-block w-100">
            <iframe src="https://hiptipsllc.securepayments.cardpointe.com/pay?&mini=1&total={{ $total }}" frameborder="0" width="100%" height="600">
            </iframe>
          </div>
        </div>
      </div>
    </section>
  </fieldset>
</form>





<x-tipfooter/>