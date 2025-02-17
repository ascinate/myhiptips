<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminEmployeeController extends Controller
{
    public function employee()
    {
        $id = Session::get('emp_id');
        
        $tips = DB::table('tips_master')
        ->whereRaw("find_in_set(?, employee)", [$id])
        ->get();

        return view('employee.login', compact('tips'));
       
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $employee = DB::table('employee_master')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
    
        if ($employee) {
            $request->session()->put('employeeuser', $employee->email);
            $request->session()->put('emp_first', $employee->first_name);
            $request->session()->put('emp_last', $employee->last_name);
            $request->session()->put('emp_id', $employee->id);
            $request->session()->put('photo', $employee->photo);
            
            return redirect('/employee/dashboard');
        } else {
            return redirect('/employee/login')->with('msg', 'Invalid email or password.');
        }
    }

    public function dashboard(Request $request)
    {

        $data['tips'] = $this->tips($request);
        return view('employee.dashboard', $data);
        
    }

        public function tips(Request $request)
        {
            $corId = Session::get('hotel_id');
            $to = $request->input('date_to');
            $from = $request->input('date_from');
            $employee = Session::get('emp_id');
            $department = Session::get('department');

            $query = DB::table('tips_master');

            if (!empty($to) && !empty($from)) {
                $query->whereBetween('date_of_tip', [$to, $from]);
            }

            if (!empty($department)) {
                $query->where('department', $department);
            }

            if (!empty($employee)) {
                $query->where('employee', 'like', "%$employee%");
            }

            if (!empty($corId)) {
                $query->where('hotel', $corId);
            }

            return $query->get();
        }
        

        public function employeeedit()
        {
            $empId = Session::get('emp_id');
            $employee = DB::table('employee_master')->where('id', $empId)->first();
          
            return view('employee.editprofile', compact('employee'));
    
    
    
        }

        public function updateProfile(Request $request)
        {
            $id = Session::get('emp_id');
        $employee = DB::table('employee_master')->where('id', $id)->first();
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Profile not found!');
        }
    
        
        DB::table('employee_master')
            ->where('id', $id)
            ->update([
                'first_name'    => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'email'      => $request->input('email'),
                'password'  => $request->input('password'),
                'phone'         => $request->input('phone'),
            
            ]);
    
      
        return redirect('/employee/edit')->with('msg', 'Profile updated successfully!');
        }

    public function employeelogin(){
        Auth::logout();
        return redirect('/employee/login');
    }

}
