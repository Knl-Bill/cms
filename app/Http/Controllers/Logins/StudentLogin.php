<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentLogin extends Controller
{
    //
    public function StudentDashboard()
    {
        return view('Logins.StudentPages.StudentDashboard');
    }
    public function StudentLoginVerify(Request $request)
    {
        $request->validate([
            'rollno' => 'required',
            'password' => 'required',
        ]);

        $rollno = $request->input('rollno');
        $password = $request->input('password');

        // Retrieve the user by their phone number
        $user = DB::table('students')->where('rollno', $rollno)->first();
        if($user) 
        {
            // If the user exists, check if the password matches
            if(HASH::check($password,$user->password)) 
            {
                // Password matches, redirect to dashboard
                Session::put('user',$user);
                return redirect()->route('StudentDashboard');
            } 
            else 
            {
                // Password does not match, show error message
                return redirect()->back()->with('error', 'Wrong password');
            }
        } 
        else 
        {
            // User not found, show error message
            return redirect()->back()->with('error', 'User not found');
        }
    }
    public function StudentSession() 
    {
        $user = Session::get('user');
        if($user)
            return $user->name;
        else   
            return "Guest";
    }
    public function StudentLogout()
    {
        Session::forget('user');
        return redirect('/');
    }
}
