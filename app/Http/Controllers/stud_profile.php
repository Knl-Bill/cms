<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class stud_profile extends Controller
{
    public function changePassword(Request $request)
    {
        return view('profile.stud_update');
    }
 
    public function changePasswordSave(Request $request)
    {
        
        $request->validate([
            'curr_pass' => 'required|min:8',
            'new_pass' => 'required|min:8',
            'confirmpass' => 'required|same:new_pass'
        ]);
 
        // The passwords matches
        $rollno = $request->input('rollno');
        $curr_pass = $request->input('curr_pass');
        
        if(DB::table('students')->where('rollno',$rollno)->exists())
        {
            $user = DB::table('students')->where('rollno', $rollno)->value('password');            
            if(HASH::check($curr_pass,$user))
            {
                if (strcmp($request->input('curr_pass'), $request->input('new_pass')) == 0)
                {
                    return back()->withInput()->withErrors(['new_pass' => 'New Password cannot be same as Current Password']);
                }
                DB::table('students')
                    ->where('rollno', $rollno)
                    ->update(['password' => Hash::make($request->new_pass)]);
                return back()->with('success',"Password updated successfully");
            }
            else
                return back()->withInput()->withErrors(['curr_pass' => 'Current Password is Invalid!']);
        }
    }
        
        //Change Room Number
    public function changeroomno(Request $request)
    {
        $request->validate([
            'new_roomno' => 'required',
        ]);
        $rollno = $request->input('rollno');
        $curr_pass = $request->input('curr_pass');
        if(DB::table('students')->where('rollno',$rollno)->exists())
        {          
            DB::table('students')
                ->where('rollno', $rollno)
                ->update(['roomno' => $request->new_roomno]);
            return back()->with('success',"Room Number updated successfully");
        }
        else
            return back()->withInput()->withErrors(['curr_pass' => 'Current Password is Invalid!']);
    }


    //Change Hostel
    public function changehostel(Request $request)
    {
        $request->validate([
            'new_hostelname' => 'required',
        ]);
        $rollno = $request->input('rollno');
        $curr_pass = $request->input('new_hostelname');
        if(DB::table('students')->where('rollno',$rollno)->exists())
        {          
            DB::table('students')
                ->where('rollno', $rollno)
                ->update(['hostelname' => $request->new_hostelname]);
            return back()->with('success',"Hostel updated successfully");
        }
        else
            return back()->withInput()->withErrors(['curr_pass' => 'Current Password is Invalid!']);
    }


    //Change phone number
    public function changephoneno(Request $request)
    {
        $request->validate([
            'new_phoneno' => 'required|min:10|max:10',
        ]);
        $rollno = $request->input('rollno');
        $new_phoneno = $request->input('new_phoneno');
        if(DB::table('students')->where('rollno',$rollno)->exists() && !(DB::table('students')->where('phoneno',$new_phoneno)->exists()))
        {          
            DB::table('students')
                ->where('rollno', $rollno)
                ->update(['phoneno' => $request->new_phoneno]);
            return back()->with('success',"Phone Number updated successfully");
        }
        else
            return back()->withInput()->withErrors(['new_phoneno' => 'This Phone Number is Already in Use!']);
    }


    //Change Email Adress
    public function changeemail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email',
        ]);
        $rollno = $request->input('rollno');
        $new_email = $request->input('new_email');
        if(DB::table('students')->where('rollno',$rollno)->exists() && !(DB::table('students')->where('email',$new_email)->exists()))
        {          
            DB::table('students')
                ->where('rollno', $rollno)
                ->update(['email' => $request->new_email]);
            return back()->with('success',"E-Mail Address updated successfully");
        }
        else
            return back()->withInput()->withErrors(['new_email' => 'This E-Mail is Already in Use!']);
    }

}
