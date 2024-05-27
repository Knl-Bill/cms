<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function AdminLogin()
    {
        return view('Logins.Admin');
    }
    public function StudentLogin()
    {
        return view('Logins.Student');
    }
    public function SecurityLogin()
    {
        return view('Logins.Security');
    }
    public function StudentSignUp()
    {
        $stmt="select * from admin_logins;"; 
        $students = DB::select($stmt);
        return view('Logins.StudentSignUp',['students'=>$students]);
    }
    public function SecurityDashboard()
    {
        return view('Logins.SecurityPages.Landing');
    }
}
