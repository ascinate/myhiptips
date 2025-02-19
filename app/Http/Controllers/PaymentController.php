<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;

class PaymentController extends Controller
{
    public function showPaymentForm($id)
    {
        $tip = Tip::findOrFail($id);
        return view('payment', compact('tip'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'card_number' => 'required|numeric|digits_between:13,19',
            'year' => 'required|digits:4',
            'month' => 'required|digits:2',
            'cvc' => 'required|numeric|digits:3',
        ]);

        $tip = Tip::findOrFail($request->input('tip_id'));
        $tip->status = 'paid';
        $tip->save();

        return redirect()->route('tipping.page')->with('success', 'Payment Successful!');
    }
}
