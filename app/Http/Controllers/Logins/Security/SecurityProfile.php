<?php
namespace App\Http\Controllers\Logins\Security;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class SecurityProfile extends Controller
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
        $phoneno = $user->phoneno;
        $curr_pass = $request->input('curr_pass');

        if(DB::table('security_logins')->where('phoneno',$phoneno)->exists())
        {
            $user = DB::table('security_logins')->where('phoneno', $phoneno)->value('password');            
            if(HASH::check($curr_pass,$user))
            {
                if (strcmp($request->input('curr_pass'), $request->input('new_pass')) == 0)
                {
                    return back()->withInput()->withErrors(['new_pass' => 'New Password cannot be same as Current Password']);
                }
                DB::table('security_logins')
                    ->where('phoneno', $phoneno)
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
        $phoneno = $user->phoneno;
        $new_phoneno = $request->input('new_phoneno');
        if(DB::table('security_logins')->where('phoneno',$phoneno)->exists() && !(DB::table('security_logins')->where('phoneno',$new_phoneno)->exists()))
        {          
            DB::table('security_logins')
                ->where('phoneno', $phoneno)
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
        if(DB::table('security_logins')->where('email',$email)->exists() && !(DB::table('security_logins')->where('email',$new_email)->exists()))
        {          
            DB::table('security_logins')
                ->where('email', $email)
                ->update(['email' => $request->new_email]);
            return back()->with('success',"E-Mail address updated Successfully!");

        }
        else
            return back()->withInput()->withErrors(['new_email' => 'This E-Mail is Already in Use!']);
    }

}
