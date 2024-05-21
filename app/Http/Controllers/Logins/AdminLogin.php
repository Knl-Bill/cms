<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminLogin extends Controller
{
    //
    public function AdminDashboard()
    {
        return view('Logins.AdminPages.AdminDashboard');
    }
    public function AdminLoginVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|min:8|max:100',
            'password' => 'required',
        ]);
        //$validator = Validator::make($request->all(), $rules);
       
        $email = $request->input('email');
        $password = $request->input('password');

        // Retrieve the user by their phone number
        $user = DB::table('admin_login')->where('email', $email)->first();
        if($user) 
        {
            // If the user exists, check if the password matches
            if($password === $user->password) 
            {
                // Password matches, redirect to dashboard
                Session::put('user',$user);
                return redirect()->route('AdminDashboard');
            } 
            else 
            {
                // Password does not match, show error message
                return back()->withInput()->withErrors(['password' => 'Wrong Password!']);
            }
        } 
        else 
        {
            // User not found, show error message
            return back()->withInput()->withErrors(['email' => 'User does not Exist!']);
        }
    }
    public function AdminSession()
    {
        $user = Session::get('user');
        if($user)
            return $user->name;
        else   
            return "Guest";
    }
    public function AdminLogout()
    {
        Session::forget('user');
        return redirect('/');
    }
}
