<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AdminTipsController extends Controller
{
    public function index(Request $request)
    {
        $id = Session::get('emp_id');
        $emp =  DB::table('employee_master')
        ->where('id', $id)
        ->first();
        $request->session()->put('hotel_id', $emp->hotel_id);
        $request->session()->put('first_name', $emp->first_name);
        $request->session()->put('last_name', $emp->last_name);
        $request->session()->put('department', $emp->department);
        
        if (!$id) {
            return redirect()->route('employee.login');
        }

        $tips = $this->getTips($request);
        $employees = $this->getEmployeeTipHistory($id);
        $sum = DB::table('tips_master')
            ->whereRaw("FIND_IN_SET(?, employee)", [$id])
            ->sum('each_share');
        
        return view('employee.tips', compact('tips', 'employees', 'sum'));
    }

    private function getTips(Request $request)
    {
        $hotelId = Session::get('hotel_id');
        $to = $request->input('date_to');
        $from = $request->input('date_from');
        $employee = Session::get('emp_id');
        $department = session('department');

        $query = DB::table('tips_master');

        if ($to && $from && $department && $employee) {
            $query->whereBetween('date_of_tip', [$from, $to])
                ->where('employee', 'like', "%$employee%")
                ->where('department', $department)
                ->where('hotel', $hotelId);
        } elseif ($to && $from && $department) {
            $query->whereBetween('date_of_tip', [$from, $to])
                ->where('department', $department)
                ->where('hotel', $hotelId);
        } elseif ($to && $from && $employee) {
            $query->whereBetween('date_of_tip', [$from, $to])
                ->where('employee', 'like', "%$employee%")
                ->where('hotel', $hotelId);
        } else {
            $query->whereRaw("FIND_IN_SET(?, employee)", [$employee]);
        }

        return $query->get();
    }

    private function getEmployeeTipHistory($id)
    {
        return DB::table('tips_master')
            ->whereRaw("FIND_IN_SET(?, employee)", [$id])
            ->get();
    }
}
