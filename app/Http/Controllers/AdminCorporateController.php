<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use App\Models\Admin;


class AdminCorporateController extends Controller
{

    public function corporatelogin()
    {
        return redirect('corporate/login');
    }
    public function showLoginForm()
    {
        return view('corporate.login'); 
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('corporate.login')->with('msg', 'Logged out successfully');
    }

}    
?>