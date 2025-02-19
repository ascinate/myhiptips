<div class="container">
    <h1 class="text-center">Payment</h1>

    <h2> Paying: ${{ $tip->tip_amount }} </h2>

    <form method="post" action="{{ route('payment.process') }}">
        @csrf
        <input type="hidden" name="tip_id" value="{{ $tip->id }}">

        <div class="mb-3">
            <label class="form-label">Card Holder Name*</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Credit/Debit Card Number*</label>
            <input type="text" name="card_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Expiry Date*</label>
            <div class="d-flex">
                <select name="year" class="form-select me-2">
                    @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
                <select name="month" class="form-select">
                    @for($month = 1; $month <= 12; $month++)
                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">CVC*</label>
            <input type="password" name="cvc" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Pay Now</button>
    </form>
</div>