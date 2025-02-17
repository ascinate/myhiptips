<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

    public function corporate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'login_type' => 'required|in:Manager,Office'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $logintype = $request->input('login_type');

        if ($logintype === 'Manager') {
            $user = DB::table('hotel_master')->where('email', $email)->where('password', $password)->first();
        } else {
            $user = DB::table('department_master')->where('email', $email)->where('password', $password)->first();
            if ($user) {
                $hotel = DB::table('hotel_master')->where('id', $user->hotel_id)->first();
            }
        }

        if ($user) {
            session([
                'cor_id' => $logintype === 'Manager' ? $user->id : $user->hotel_id,
                'cor_email' => $user->email,
                'cor_hotel' => $logintype === 'Manager' ? $user->hotel_name : ($hotel->hotel_name ?? ''),
                'code' => $logintype === 'Manager' ? $user->active_code : ($hotel->active_code ?? ''),
            ]);

            return redirect('corporate/dashboard');
        } else {
            return redirect('corporate/login')->with('msg', 'Wrong email or password!');
        }
    }

    public function dashboard()
    {
        $hotelId = Session::get('cor_id');

        // Fetch total tips for the logged-in hotel
        $sum_total = DB::table('tips_master')
            ->where('hotel', $hotelId)
            ->sum('tip_amount');

        // Fetch total transactions count
        $total_num = DB::table('tips_master')
            ->where('hotel', $hotelId)
            ->count();

        // Fetch average tip amount
        $averageTip = $total_num > 0 ? $sum_total / $total_num : 0;

        // Fetch total employees count
        $totalEmployees = DB::table('employee_master')
            ->where('hotel_id', $hotelId)
            ->count();

        // Fetch recent tips with related hotel and employee data
        $tips = DB::table('tips_master')
            ->join('hotel_master', 'tips_master.hotel', '=', 'hotel_master.id')
            ->select('tips_master.*', 'hotel_master.hotel_name')
            ->orderBy('tips_master.id', 'desc')
            ->get();

        return view('corporate.dashboard', compact(
            'sum_total',
            'total_num',
            'averageTip',
            'totalEmployees',
            'tips'
        ));
    }

    public function editprofile()
    {
        $hotelId = Session::get('cor_id');
        $corporate = DB::table('hotel_master')->where('id', $hotelId)->first();

        return view('corporate.editprofile', compact('corporate'));



    }

    public function updateProfile(Request $request)
    {
        $id = Session::get('cor_id');
        $corporate = DB::table('hotel_master')->where('id', $id)->first();
    
        if (!$corporate) {
            return redirect()->back()->with('error', 'Profile not found!');
        }
    
        $photo = $corporate->photo;
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('uploads', 'public');
        }
    
        DB::table('hotel_master')
            ->where('id', $id)
            ->update([
                'hotel_name'    => $request->input('hotel_name'),
                'email'         => $request->input('email'),
                'password'      => $request->input('password'),
                'contact_name'  => $request->input('contact_name'),
                'phone'         => $request->input('phone'),
                'photo'         => $photo,
                'street'        => $request->input('street'),
                'state'         => $request->input('state'),
                'zipcode'       => $request->input('zipcode'),
                'all_staff'     => $request->input('all_staff'),
                'is_department' => $request->input('is_department'),
            ]);
    
      
        return redirect('/corporate/dashboard/editprofile')->with('msg', 'Profile updated successfully!');
    }

    public function employees()
    {

        $id = Session::get('cor_id');
        if (!$id) {
            return redirect('/corporate/login', 'refresh');
        }
    
        $data['employees'] = DB::table('employee_master')
                                ->where('hotel_id', $id)
                                ->where('is_archive', 'N')
                                ->orderBy('first_name')
                                ->get();
    
        return view('corporate.employees', $data);
    }

    public function add(){
       
           
           
            return view('corporate.addemployee');
           
    
    }

    public function insertCorporate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:employee_master,email', // Ensure email is unique
            'password' => 'required|string|min:8', // Validate password length
            'department' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate photo upload
        ]);

      

    if ($request->hasFile('photo')) {
        $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $filePath = public_path('uploads');
        $request->file('photo')->move($filePath, $fileName);
        
    }
  
    
    

      
      
        // Insert employee data into the database
        DB::table('employee_master')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'hotel_id' => Session::get('cor_id'),
            'department' => $request->department,
            'photo' => $fileName,
        ]);
         
   
     
        return redirect('/corporate/employees');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('corporate.login')->with('msg', 'Logged out successfully');
    }

}    
?>


