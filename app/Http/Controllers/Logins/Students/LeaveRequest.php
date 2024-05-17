<?php

namespace App\Http\Controllers\Logins\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LeaveRequest extends Controller
{
    public function LeaveRequestPage()
    {
        return view('Logins.StudentPages.LeaveRequest');
    }
    public function InsertLeaveRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rollno' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phoneno' => 'required|string|max:10',
            'placeofvisit' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'outdate' => 'required|date',
            'outime' => 'required',
            'indate' => 'required|date',
            'intime' => 'required',
            'noofdays' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        // Handle validation failures
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Insert the data into the database
        DB::table('leavereqs')->insert([
            'rollno' => $request->input('rollno'),
            'name' => $request->input('name'),
            'phoneno' => $request->input('phoneno'),
            'placeofvisit' => $request->input('placeofvisit'),
            'purpose' => $request->input('purpose'),
            'outdate' => $request->input('outdate'),
            'outime' => $request->input('outime'),
            'indate' => $request->input('indate'),
            'intime' => $request->input('intime'),
            'noofdays' => $request->input('noofdays'),
            'image' => $imagePath
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Leave request submitted successfully.');
    }
    public function DisabledDetails()
    {
        $user = Session::get('user');
        if($user)
        {
            return response()->json([
                'rollno' => $user->rollno,
                'name' => $user->name,
                'phoneno' => $user->phoneno
            ]);
        }
        else{
            return response()->json(['message' => 'Guest'], 401);
        }
    }
}