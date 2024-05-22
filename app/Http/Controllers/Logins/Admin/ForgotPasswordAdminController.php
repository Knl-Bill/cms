<?php

namespace App\Http\Controllers\Logins\Admin;
use App\Http\Requests;
use App\Models\password_reset_admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use DB;
use Carbon\Carbon;
use Mail;
use Hash;
class ForgotPasswordAdminController extends Controller
{
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('Logins.AdminPages.forgetPassword');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:security_login',
          ]);
  
          $token = Str::random(64);
          if(DB::table('password_reset_admin')->where('email',$request->email)->exists())
          {
            return back()->with('message', 'We have already e-mailed your password reset link! Please check your email');
          }
          DB::table('password_reset_admin')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.AdminforgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token)
      { 
         return view('Logins.AdminPages.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:security_login',
              'password' => 'required|string|min:8|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_reset_admin')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = DB::table('admin_login')->where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_reset_admin')->where(['email'=> $request->email])->delete();
  
          return redirect()->route('AdminLogin')->with('success',"Password Changed Successfully");
      }
}
