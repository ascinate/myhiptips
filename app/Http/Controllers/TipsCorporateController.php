<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class TipsCorporateController extends Controller
{
    public function index()
    {
        $corId = Session::get('cor_id'); // Fetching the cor_id from session

        if (!$corId) {
            return redirect()->route('corporate.login'); // Redirect if cor_id is not found in session
        }

        // Fetching data from the database using DB query builder
        $tips = DB::table('tips_master')->get();
        $employees = DB::table('employee_master')
            ->where('hotel_id', $corId)
            ->where('is_archive', 'N')
            ->orderBy('first_name')
            ->get();
        $hotels = DB::table('hotel_master')
            ->where('id', $corId)
            ->get();

        return view('corporate.tips', compact('tips', 'employees', 'hotels'));
    }

    public function total()
    {
        $corId = Session::get('cor_id'); // Fetching the cor_id from session

        $employees = DB::table('employee_master')
            ->where('hotel_id', $corId)
            ->get();
        $hotels = DB::table('hotel_master')
            ->where('id', $corId)
            ->get();
         
        return view('corporate.tips_total', compact('employees', 'hotels'));
    }

    public function tips(Request $request)
    {
        $corId = Session::get('cor_id'); // Fetching the cor_id from session

    // Fetch filters from request
    $dateTo = $request->input('date_to');
    $dateFrom = $request->input('date_from');
    $hotelId = $request->input('hotel_id');
    $employeeId = $request->input('employee');
    $department = $request->input('department');

    // Building the query based on filters
    $tipsQuery = DB::table('tips_master')->where('hotel', $corId);

    if ($dateTo && $dateFrom) {
        $tipsQuery->whereBetween('date_of_tip', [$dateFrom, $dateTo]);
    }

    if ($employeeId) {
        $tipsQuery->whereRaw("FIND_IN_SET(?, employee)", [$employeeId]);
    }

    if ($department) {
        $tipsQuery->where('department', $department);
    }

    $tips = $tipsQuery->orderByDesc('id')->get();

    // Fetch employees and hotels
    $employees = DB::table('employee_master')->where('hotel_id', $corId)->where('is_archive', 'N')->orderBy('first_name')->get();
    $hotels = DB::table('hotel_master')->where('id', $corId)->get();

    return view('corporate.tips', compact('tips', 'employees', 'hotels'));
    }
    

    public function dashboardtips()
    {
        $corId = Session::get('cor_id'); // Fetching the cor_id from session

        // Fetching employees related to the hotel (corId)
        $employees = DB::table('employee_master')
            ->where('hotel_id', $corId)
            ->get();

        return response()->json($employees); // Returning employees data as JSON
    }
}
