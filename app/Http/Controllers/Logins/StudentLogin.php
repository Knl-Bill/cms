<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $rules = [
            'rollno'=>'required|string|min:9|max:9|exists:students',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return redirect('StudentLogin')->withInput()->withErrors($validator);
        }
        else
        {
            $rollno = $request->input('rollno');
            $user1 = DB::table('students')->where('rollno', $rollno)->first();
            if(DB::table('students')->where('rollno',$rollno)->exists())
            {
                $password= $request->input('password');
                $user = DB::table('students')->where('rollno', $rollno)->value('password');
                if(HASH::check($password,$user))
                {
                    Session::put('user',$user1);
                    return redirect()->route('StudentDashboard');
                }
                    
                else
                    return back()->withInput()->withErrors(['password' => 'Wrong Password!']);
            }
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
