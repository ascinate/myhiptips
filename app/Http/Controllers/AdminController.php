<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); 
    }
    public function adminlogout()
    {
        return redirect('admin/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $admin = DB::table('admin_master')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
    
        if ($admin) {
            $request->session()->put('adminuser', $admin->email);
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with('error', 'Invalid email or password.');
        }
    }

    public function dashboard()
    {
         // Fetch total tips
    $sum = DB::table('tips_master')->sum('tip_amount');

    // Fetch admin commission
    $adminCommission = DB::table('tips_master')->sum('admin_commission');

    // Fetch total transactions count
    $totalTransactions = DB::table('tips_master')->count();

    // Fetch average tip amount
    $averageTip = $totalTransactions > 0 ? $sum / $totalTransactions : 0;

    // Fetch total properties count
    $totalProperties = DB::table('hotel_master')->count();

    // Fetch total employees count
    $totalEmployees = DB::table('employee_master')->count();

    // Fetch recent tips
    $tips = DB::table('tips_master')->get();

    return view('admin.dashboard', compact(
        'sum',
        'adminCommission',
        'totalTransactions',
        'averageTip',
        'totalProperties',
        'totalEmployees',
        'tips'
    ));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('msg', 'Logged out successfully');
    }
}
