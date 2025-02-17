<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Tip;

class TippingController extends Controller
{
    public function showForm(Request $request)
    {
        $activeCode = $request->query('code');

        // Fetch hotel using active_code
        $hotel = Hotel::where('active_code', $activeCode)->first();

        if (!$hotel) {
            return abort(404, 'Hotel Not Found');
        }

        // Fetch employees linked to this hotel
        $employees = Employee::where('hotel_id', $hotel->id)->get();
        $departments = Department::pluck('name');

        return view('admin.tip', compact('hotel', 'employees', 'activeCode', 'departments'));
    }

    public function submitTip(Request $request)
    {
        // Validate input based on selected tip type
        $request->validate([
            'tip_type' => 'required|in:employee,department',
            'room' => 'required|string',
            'lname' => 'required|string',
            'tip' => 'required|numeric|min:1',
            'department' => 'required_if:tip_type,department|string|nullable',
            'employee' => 'required_if:tip_type,employee|array|nullable',
        ]);

        // Determine tip amount
        $tipAmount = $request->tip;
        $commission = ($tipAmount * 18) / 100;
        $finalAmount = $tipAmount - $commission;

        // If selecting employee, get employee IDs
        $employeeIds = ($request->tip_type == 'employee') ? json_encode($request->employee) : null;

        // If selecting department, get department name
        $department = ($request->tip_type == 'department') ? $request->department : null;

        // Save to database
        $tip = Tip::create([
            'tip_type' => $request->tip_type,
            'room_number' => $request->room,
            'last_name' => $request->lname,
            'tip_amount' => $tipAmount,
            'final_amount' => $finalAmount,
            'admin_commission' => $commission,
            'each_share' => $finalAmount, // Assuming equal distribution
            'department' => $department,
            'employees' => $employeeIds,
        ]);

        // Generate payment code
        $code = base64_encode($tip->id . str_random(5));

        return redirect()->route('admin.pay', ['code' => $code]);
    }

    public function filterTips(Request $request) 
    {
        $query = Employee::query();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('employee')) {
            $query->where('id', $request->employee);
        }

        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', $request->hotel_id);
        }

        $employeesList = $query->get();
        $hotels = Hotel::all();
        $employees = Employee::all();
        $from = $request->date_from;
        $to = $request->date_to;

        return view('admin.totaltips', compact('employeesList', 'hotels', 'employees', 'from', 'to'));
    }

    public function viewTips() 
    {
        $hotels = Hotel::all(); 
        $employees = Employee::all(); 
        $tips = Tip::all();
        return view('admin.viewtips', compact('hotels', 'employees', 'tips'));
    }


}
