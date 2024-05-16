<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SecurityLogin extends Controller
{
    //
    public function SecurityLoginVerify(Request $request)
    {
        $request->validate([
            'phoneno' => 'required',
            'password' => 'required',
        ]);

        $phoneNumber = $request->input('phoneno');
        $password = $request->input('password');

        // Retrieve the user by their phone number
        $user = DB::table('security_login')->where('phoneno', $phoneNumber)->first();
        if($user) 
        {
            // If the user exists, check if the password matches
            if($password === $user->password) 
            {
                // Password matches, redirect to dashboard
                Session::put('user',$user);
                return redirect()->route('SecurityDashboard');
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
    public function SecuritySession() 
    {
        $user = Session::get('user');
        if($user)
            return $user->name;
        else   
            return "Guest";
    }
}
