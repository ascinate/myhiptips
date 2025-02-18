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
            $corId = Session::get('cor_id'); // Get corporate ID from session
    
            // Start building the query
            $query = DB::table('tips_master')
                ->join('employee_master', 'employee_master.id', '=', 'tips_master.employee')
                ->join('hotel_master', 'hotel_master.id', '=', 'tips_master.hotel')
                ->where('tips_master.hotel', $corId);  // Only select tips for the current corporate ID
    
            // Apply filters based on request parameters
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('tips_master.date_of_tip', [$request->date_from, $request->date_to]);
            }
    
            if ($request->filled('hotel_id')) {
                $query->where('tips_master.hotel', $request->hotel_id);
            }
    
            if ($request->filled('employee')) {
                $query->whereIn('tips_master.employee', (array) $request->employee); // Ensure employee is an array
            }
    
            if ($request->filled('department')) {
                $query->where('tips_master.department', $request->department);
            }
    
            // Select the columns needed from the joined tables
            $tips = $query->select(
                'tips_master.*',
                'employee_master.first_name as employee_first_name',
                'employee_master.last_name as employee_last_name',
                'hotel_master.hotel_name'
            )->get();
    
            // Fetch all hotels related to the corporate ID for the filter dropdown
            $hotels = DB::table('hotel_master')
                ->where('hotel_master.id', $corId)
                ->get();
    
            // Return the data to the view
            return view('corporate.tips', compact('tips', 'hotels'))
                ->with([
                    'date_from' => $request->date_from,
                    'date_to' => $request->date_to,
                    'hotel_id' => $request->hotel_id,
                    'employee_id' => $request->employee,
                    'department' => $request->department,
                ]);
        }

    





    // public function dashboardtips()
    // {
    //     $corId = Session::get('cor_id'); // Fetching the cor_id from session

    //     // Fetching employees related to the hotel (corId)
    //     $employees = DB::table('employee_master')
    //         ->where('hotel_id', $corId)
    //         ->get();

    //     return response()->json($employees); // Returning employees data as JSON
    // }
}
