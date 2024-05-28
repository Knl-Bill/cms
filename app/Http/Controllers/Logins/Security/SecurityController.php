<?php

namespace App\Http\Controllers\Logins\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SecurityController extends Controller
{
    public function OutingText()
    {
        return view('Logins.SecurityPages.Outing.TextInput');
    }
    public function LeaveText()
    {
        return view('Logins/SecurityPages.Leave.TextInput');
    }
    public function OutingScanner()
    {
        return view('Logins.SecurityPages.Outing.OutingScanner');
    }
    public function LeaveScanner()
    {
        return view('Logins.SecurityPages.Leave.LeaveScanner');
    }
}
