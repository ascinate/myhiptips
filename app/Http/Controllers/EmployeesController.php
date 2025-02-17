<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class EmployeesController extends Controller
{
  

    public function index()
    {
       
        $employees = DB::table('employee_master')->get();
        return view('admin.employees', compact('employees'));
       
    }

    public function add()
    {
       
        $hotels = DB::table('hotel_master')->get();
        return view('admin.employeesadd',compact('hotels'));
       
    }

    public function insertEmployee(Request $request)
    {
        // dd($request);
       
        // Validate the incoming data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:employee_master,email', // Ensure email is unique
            'password' => 'required|string|min:8', // Validate password length
            'hotel_id' => 'required|exists:hotel_master,id', // Validate hotel ID
            'department' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate photo upload
        ]);

      

    if ($request->hasFile('photo')) {
        $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $filePath = public_path('uploads');
        $request->file('photo')->move($filePath, $fileName);
        
    }
  
    
    
    $hashedPassword = Hash::make($request->password);
      
      
        // Insert employee data into the database
        DB::table('employee_master')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $hashedPassword,
            'hotel_id' => $request->hotel_id,
            'department' => $request->department,
            'photo' => $fileName,
        ]);

        
         
   
     
        return redirect()->route('admin.employees');
    }

    public function viewEmployee($id)
    {
       
        $employee = DB::table('employee_master')->find($id);

        if (!$employee) {
            return redirect()->route('admin.employees.add')->with('error', 'Employee not found.');
        }

        
        $tips = DB::table('tips_master')
            ->whereRaw("FIND_IN_SET(?, `employee`)", [$id])
            ->get();

        
        $totalEarnings = $tips->sum('each_share');

        return view('admin.viewemployee', compact('employee', 'tips', 'totalEarnings'));
    }

    public function edit($id)
    {
     
       

   
        $employee = DB::table('employee_master')->where('id', $id)->first();
 
        $hotels = DB::table('hotel_master')->get();

        return view('admin.editemployee', compact('employee', 'hotels'));
    }

   
    public function update_employee(Request $request)
    {
        
        $id = $request->input('id');
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $photo = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $photo);
        } else {
           
            $employee = DB::table('employee_master')->where('id', $id)->first();
            $photo = $employee->photo;
        }

    
        $data = [
            'hotel_id' => $request->input('hotel_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'department' => $request->input('department'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'photo' => $photo,
            'password' => $request->input('password'),
        ];

       
        DB::table('employee_master')->where('id', $id)->update($data);
        return redirect()->route('admin.employees');
    }

    public function delete($id)
    {
      
      

        DB::table('employee_master')
        ->where('id', $id)
        ->where(['is_archive' => 'Y'])
        ->delete();

        return redirect()->route('admin.employees');
    }

}    