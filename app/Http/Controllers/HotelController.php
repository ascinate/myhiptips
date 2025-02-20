<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Tip;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::where('is_active', 'Y')->orderBy('hotel_name')->get();
        return view('admin.hotel', ['hotels' => $hotels]);
    }

    public function create()
    {
        return view('admin.addhotel');
    }

    public function store(Request $request)
    {
        $request->validate([
        'hotel_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'contact_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:hotel_master,email',
        'password' => 'required|min:6',
        'additional_email' => 'nullable|email|max:255',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'street' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zipcode' => 'required|string|max:10',
        'all_staff' => 'required|in:Y,N',
        'is_department' => 'required|in:Y,N',
        'is_commission' => 'required|in:Y,N',
        'tripadvisor_link' => 'nullable|url|max:500',
    ]);

        // Generate a unique activation code
        $uniqueCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 10);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $imageName);
        } else {
            $imageName = null;
        }

        Hotel::create([
            'hotel_name' => $request->hotel_name,
            'phone' => $request->phone,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'additional_email' => $request->additional_email,
            'photo' => $imageName,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'all_staff' => $request->all_staff,
            'is_department' => $request->is_department,
            'is_commission' => $request->is_commission,
            'tripadvisor_link' => $request->tripadvisor_link,
            'active_code' => $uniqueCode, // Store the activation code
        ]);

        return redirect()->route('admin.hotel')->with('success', 'Hotel added successfully!');
    }

    public function edit($id)
    {
        $values = Hotel::where('id', $id)->get(); // Retrieve hotel data
        return view('admin.edithotel', compact('values'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'additional_email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'all_staff' => 'required|in:Y,N',
            'is_department' => 'required|in:Y,N',
            'is_commission' => 'required|in:Y,N',
            'tripadvisor_link' => 'nullable|url',
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->hotel_name = $request->hotel_name;
        $hotel->phone = $request->phone;
        $hotel->contact_name = $request->contact_name;
        $hotel->email = $request->email;
        
        // Update password only if provided
        if ($request->password) {
            $hotel->password = Hash::make($request->password);
        }

        $hotel->additional_email = $request->additional_email;
        $hotel->street = $request->street;
        $hotel->city = $request->city;
        $hotel->state = $request->state;
        $hotel->zipcode = $request->zipcode;
        $hotel->all_staff = $request->all_staff;
        $hotel->is_department = $request->is_department;
        $hotel->is_commission = $request->is_commission;
        $hotel->tripadvisor_link = $request->tripadvisor_link;

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($hotel->photo) {
                Storage::delete('uploads/' . $hotel->photo);
            }

            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileName);
            $hotel->photo = $fileName;
        }

        $hotel->save();

        return redirect()->route('admin.hotel')->with('success', 'Hotel updated successfully.');
    }

    public function show($id)
    {
        // Retrieve hotel details
        $hotel = Hotel::findOrFail($id);

        // Calculate total earnings for the hotel
        $totalEarnings = Tip::where('hotel', $id)->sum('tip_amount');

        // Fetch tips history related to this hotel
        $tips = Tip::where('hotel', $id)->get();

        // Pass data to the Blade template
        return view('admin.showhotel', compact('hotel', 'totalEarnings', 'tips'));
    }

    public function destroy($id)
    {
        // Find the hotel by ID
        $hotel = Hotel::find($id);

        // Check if the hotel exists
        if (!$hotel) {
            return redirect()->route('admin.hotel')->with('error', 'Hotel not found.');
        }

        // Delete the hotel
        $hotel->delete();

        return redirect()->route('admin.hotel')->with('success', 'Hotel deleted successfully.');
    }

}
