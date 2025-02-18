<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Hotel;
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
               'employee_id' => $request->employee,
               'department' => $request->department
           ]);
    }
}
