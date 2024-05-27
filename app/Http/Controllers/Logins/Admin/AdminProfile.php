<?php
namespace App\Http\Controllers\Logins\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class AdminProfile extends Controller
{
    public function changePasswordSave(Request $request)
    {
        
        $request->validate([
            'curr_pass' => 'required|min:8',
            'new_pass' => 'required|min:8',
            'confirmpass' => 'required|same:new_pass'
        ]);
 
        // The passwords matches
        $user = Session::get('user');
        $email = $user->email;
        $curr_pass = $request->input('curr_pass');
        
        if(DB::table('admin_logins')->where('email',$email)->exists())
        {
            $user = DB::table('admin_logins')->where('email', $email)->value('password');            
            if(HASH::check($curr_pass,$user))
            {
                if (strcmp($request->input('curr_pass'), $request->input('new_pass')) == 0)
                {
                    return back()->withInput()->withErrors(['new_pass' => 'New Password cannot be same as Current Password']);
                }
                DB::table('admin_logins')
                    ->where('email', $email)
                    ->update(['password' => Hash::make($request->new_pass)]);
                return back()->with('success',"Password updated successfully");
            }
            else
                return back()->withInput()->withErrors(['curr_pass' => 'Current Password is Invalid!']);
        }
    }
        

    //Change phone number
    public function changephoneno(Request $request)
    {
        $request->validate([
            'new_phoneno' => 'required|min:10|max:10',
        ]);
        $user = Session::get('user');
        $email = $user->email;
        $new_phoneno = $request->input('new_phoneno');
        if(DB::table('admin_logins')->where('email',$email)->exists() && !(DB::table('admin_logins')->where('phoneno',$new_phoneno)->exists()))
        {          
            DB::table('admin_logins')
                ->where('email', $email)
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
        $user = Session::get('user');
        $email = $user->email;
        $new_email = $request->input('new_email');
        if(DB::table('admin_logins')->where('email',$email)->exists() && !(DB::table('admin_logins')->where('email',$new_email)->exists()))
        {          
            DB::table('admin_logins')
                ->where('email', $email)
                ->update(['email' => $request->new_email]);
            
            if(Session::get('role')=="faculty")
            {
                DB::table('students')
                ->where('faculty_advisor', $email)
                ->update(['faculty_advisor' => $request->new_email]);

                DB::table('leavereqs')
                ->where('faculty_email', $email)
                ->update(['faculty_email' => $request->new_email]);

                DB::table('leavereq_histories')
                ->where('faculty_email', $email)
                ->update(['faculty_email' => $request->new_email]);
            }
            else if (Session::get('role')=="warden")
            {
                DB::table('students')
                ->where('warden', $email)
                ->update(['warden' => $request->new_email]);

                DB::table('leavereqs')
                ->where('warden_email', $email)
                ->update(['warden_email' => $request->new_email]);

                DB::table('leavereq_histories')
                ->where('warden_email', $email)
                ->update(['warden_email' => $request->new_email]);
            }
            return back()->with('success',"Success! Please Logout & Login Again to refresh details!");

        }
        else
            return back()->withInput()->withErrors(['new_email' => 'This E-Mail is Already in Use!']);
    }

}
