<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tip;
use App\Models\Hotel;

class TippsController extends Controller
{
   public function showTippingPage(Request $request)
    {
        $hotel = null;
        if ($request->has('code')) {
            $hotel = Hotel::where('active_code', $request->code)->first();
        }
        return view('tipping', compact('hotel'));
    }

    public function storeTip(Request $request)
    {
        $request->validate([
            'tip' => 'required|numeric|min:1',
        ]);

        $tip = new Tip();
        $tip->hotel_code = $request->input('code');
        $tip->tip_amount = $request->input('tip');
        $tip->status = 'pending';
        $tip->save();

        return redirect()->route('payment.form', ['id' => $tip->id]);
    }
}
