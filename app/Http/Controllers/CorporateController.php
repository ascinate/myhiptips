<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class CorporateController extends Controller
{

    public function index()
    {
       
        $corporate = DB::table('department_master')->get();
        return view('admin.corporate', compact('corporate'));
       
    }

    public function add()
    {
        $hotels = DB::table('hotel_master')->get();
        return view('admin.corporateadd',compact('hotels'));
    }

    public function insertCorporate(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            
            'email' => 'required|email|unique:employee_master,email', // Ensure email is unique
            'password' => 'required|string|min:8', // Validate password length
          
        ]);

      

  
    
    
    $hashedPassword = Hash::make($request->password);
      
      
        
        DB::table('department_master')->insert([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
          
        ]);
         
   
     
        return redirect()->route('admin.corporate');
    }

    public function edit($id)
    {

        $corporate = DB::table('department_master')->where('id', $id)->first();
 
        $hotels = DB::table('hotel_master')->get();

        return view('admin.editcorporate', compact('corporate', 'hotels'));

    }

    public function update_corporate(Request $request)
    {
        $id = $request->input('id');
       

    
        $data = [
            'hotel_id' => $request->input('hotel_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

      
        DB::table('department_master')->where('id', $id)->update($data);
        return redirect()->route('admin.corporate');
    }
    
    public function delete($id)
    {
      
      

        DB::table('department_master')
        ->where('id', $id)
        ->delete();

        return redirect()->route('admin.corporate');
    }
}