<?php

namespace App\Http\Controllers\Logins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('Logins.StudentSignUp');
    }
    public function SecurityDashboard()
    {
        return view('Logins.SecurityPages.Landing');
    }
}
