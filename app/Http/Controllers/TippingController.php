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

    public function index()
    {
        $hotels = Hotel::where('is_active', 'Y')->orderBy('hotel_name')->get();
        $employees = Employee::where('is_archive', 'N')->orderBy('first_name')->get();
        return view('admin.totaltips', compact('hotels', 'employees'));
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
    return view('admin.totaltips', compact('employees', 'hotels'))
           ->with([
               'date_from' => $request->date_from,
               'date_to' => $request->date_to,
               'hotel_id' => $request->hotel_id,
               'employee' => $request->employee,
               'department' => $request->department
           ]);
    }

    public function viewTips(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $hotelId = $request->input('hotel_id');
        $employeeId = $request->input('employee');
        $department = $request->input('department');


        $tipsQuery = Tip::query();

        if ($dateFrom && $dateTo) {
            $tipsQuery->whereBetween('date_of_tip', [$dateFrom, $dateTo]);
        }
        if ($hotelId) {
            $tipsQuery->where('hotel', $hotelId);
        }
        if ($employeeId) {
            $tipsQuery->whereRaw("FIND_IN_SET(?, employee)", [$employeeId]);
        }
        if ($department) {
            $tipsQuery->where('department', $department);
        }

        $tips = $tipsQuery->get();
        $hotels = Hotel::where('is_active', 'Y')->orderBy('hotel_name')->get();
        $employees = Employee::where('is_archive', 'N')->orderBy('first_name')->get();

        return view('admin.viewtips', compact('tips', 'hotels', 'employees'));
    }


}
