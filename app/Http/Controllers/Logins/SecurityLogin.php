<?php

namespace App\Http\Controllers\Logins;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SecurityLogin extends Controller
{
    //
    public function SecurityDashboard()
    {
        return view('Logins.SecurityPages.Landing');
    }
    public function SecurityLoginVerify(Request $request)
    {
        $request->validate([
            'phoneno' => 'required|min:10|max:10',
            'password' => 'required',
        ]);
        //$validator = Validator::make($request->all(), $rules);
       
        $phoneNumber = $request->input('phoneno');
        $password = $request->input('password');

        // Retrieve the user by their phone number
        $user = DB::table('security_logins')->where('phoneno', $phoneNumber)->first();
        if($user) 
        {
            // If the user exists, check if the password matches
            if(HASH::check($password,$user->password)) 
            {
                // Password matches, redirect to dashboard
                Session::put('user',$user);
                return redirect()->route('SecurityDashboard');
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
            return back()->withInput()->withErrors(['phoneno' => 'User does not Exist!']);
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
    public function SecurityLogout()
    {
        Session::forget('user');
        return redirect('/');
    }

    public function SecurityProfile()
    {
        $user = Session::get('user');
        if($user)
        {
            $stmt="select * from security_logins where phoneno='". $user->phoneno ."';"; 
            $students = DB::select($stmt);
            return view('Logins.SecurityPages.Security_Profile',['students'=>$students]);
        }
        else
            return view('/');
    }
}
