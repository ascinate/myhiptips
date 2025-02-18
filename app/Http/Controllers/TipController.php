<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Hotel;
use App\Models\Department;
use App\Models\Tip;

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

    
    public function submitTip(Request $request)
    {
        
         $validated = $request->validate([
        'employee' => 'required_if:mnRadioDefault,employees-ts|array|min:1',
        'department' => 'required_if:mnRadioDefault,departments-mj|string',
        'room' => 'required|string',
        'lname' => 'required|string',
        'tip' => 'required|numeric',
        'custom_tip' => 'nullable|numeric|min:3',
    ]);

    
    $hotel_id = 1; 
    if ($request->has('hotel_id')) {
        $hotel_id = $request->hotel_id;
    }

    
    $tipData = [
        'room_number' => $request->room,
        'last_name' => $request->lname,
        'tip_amount' => $request->tip === 'other' ? $request->custom_tip : $request->tip,
        'employee_ids' => $request->employee ? implode(',', $request->employee) : null,
        'department' => $request->department,
        'hotel_id' => $hotel_id, 
    ];

   
    return redirect()->route('admin.pay');
    }

    public function showpay(Request $request)
    {
        
        $hotel = null;
        if ($request->has('code') && $request->code != '') {
            $hotel = Hotel::where('active_code', $request->code)->first();
        }

        return view('admin.pay', compact('hotel', 'request'));
    }

    public function processPayment(Request $request)
    {
       
        $validated = $request->validate([
            'code' => 'required',
            'mnRadioDefault' => 'nullable',
            'employee' => 'nullable|array',
            'room' => 'nullable|string',
            'department' => 'nullable|string',
            'lname' => 'nullable|string',
            'tip' => 'nullable|string',
            'other' => 'nullable|string',
            'custom_tip' => 'nullable|numeric',
            'item_name' => 'nullable|string',
            'email' => 'nullable|email',
            'currency' => 'nullable|string',
        ]);


        return redirect()->route('tip.payment.confirmation');
    }

    
}
