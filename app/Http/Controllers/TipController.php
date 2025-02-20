<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Hotel;
use App\Models\Department;
use App\Models\Tip;
use Illuminate\Support\Facades\Session;

class TipController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $employees = Employee::all();
        return view('tips.index', compact('hotels', 'employees'));
    }

    public function search(Request $request)
    {
        $query = Employee::query();

    if ($request->filled('date_from') && $request->filled('date_to')) {
        $query->whereHas('tips', function ($q) use ($request) {
            $q->whereBetween('date_of_tip', [$request->date_from, $request->date_to]);
        });
    }

    if ($request->filled('hotel_id')) {
        $query->where('hotel_id', $request->hotel_id);
    }

    if ($request->filled('employee')) {
        $query->where('id', $request->employee);
    }

    if ($request->filled('department')) {
        $query->where('department', $request->department);
    }

    $employees = $query->get();
    $hotels = Hotel::all();

    // Pass search values back to the view
    return view('tips.index', compact('employees', 'hotels'))
           ->with([
               'date_from' => $request->date_from,
               'date_to' => $request->date_to,
               'hotel_id' => $request->hotel_id,
               'employee' => $request->employee,
               'department' => $request->department
           ]);
    }


    public function showForm(Request $request)
    {
        $hotel = Hotel::first();


        if (!$hotel) {
            return redirect()->route('home')->with('error', 'Hotel information is missing.');
        }

        $employees = Employee::where('hotel_id', $hotel->id)->get();
        $departments = Department::where('hotel_id', $hotel->id)->pluck('name');

        return view('admin.tip', compact('hotel', 'employees', 'departments'));
    }

    // Handle Tip Submission
   public function submitTip(Request $request)
    {
        $validated = $request->validate([
            'mnRadioDefault' => 'required|string|in:employees-ts,departments-mj',
            'employee' => 'required_if:mnRadioDefault,employees-ts|array|min:1',
            'department' => 'required_if:mnRadioDefault,departments-mj|string',
            'room' => 'required|string',
            'lname' => 'required|string',
            'tip' => 'required|numeric|min:1',
            'custom_tip' => 'nullable|numeric|min:3',
        ]);

        $hotel_id = $request->hotel_id ?? 1; // Default to 1 if not provided

        // Calculate Final Tip Amount
        $tip_amount = ($validated['tip'] === 'other') ? $validated['custom_tip'] : $validated['tip'];
        $admin_commission = $tip_amount * 0.1; // Example: 10% commission
        $final_amount = $tip_amount - $admin_commission;

        // Prepare Tip Data
        $tipData = [
            'hotel' => $hotel_id,
            'room_number' => $validated['room'],
            'last_name' => $validated['lname'],
            'tip_amount' => $tip_amount,
            'final_amount' => $final_amount,
            'employee' => isset($validated['employee']) ? implode(',', $validated['employee']) : null,
            'department' => $validated['department'] ?? null,
            'tip_type' => $validated['mnRadioDefault'],
            'admin_commission' => $admin_commission,
            'each_share' => isset($validated['employee']) ? ($final_amount / count($validated['employee'])) : $final_amount,
            'date_of_tip' => now(),
            'status' => 'Y', // Default status
        ];

        Session::get('hotel_photo');
        Session::put('tip_data', $tipData);

       

        // Save Tip Data
        $tip = Tip::create($tipData);


        // Redirect to Payment Page with Tip Data
        return redirect()->route('admin.pay', ['tip_id' => $tip->id]);
    }



    // Show Payment Page
    public function showPay(Request $request)
    {
        $tipData = Session::get('tip_data');
        $hotel = null;
        $tips = 0.00; // Default tip value

        if ($request->has('code') && !empty($request->code)) {
            $hotel = Hotel::where('active_code', $request->code)->first();
        }

        
        $tip = null;
        if ($request->has('tip_id')) {
            $tip = Tip::find($request->tip_id);
            $tips = $tip ? $tip->tip_amount : 0.00; // Get tip amount from DB if available
        }

        return view('admin.pay', compact('hotel', 'request', 'tip', 'tips'));
    }

    // Process Payment
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'mnRadioDefault' => 'nullable|string',
            'employee' => 'nullable|array',
            'room' => 'nullable|string',
            'department' => 'nullable|string',
            'lname' => 'nullable|string',
            'tip' => 'nullable|numeric|min:1',
            'custom_tip' => 'nullable|numeric|min:3',
            'item_name' => 'nullable|string',
            'email' => 'nullable|email',
            'currency' => 'nullable|string',
        ]);

        // Redirect to payment success page
        return redirect()->route('admin.succes')->with('success', 'Payment processed successfully!');
    }

    
}
