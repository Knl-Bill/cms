<?php

namespace App\Http\Controllers\Logins\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OutingHistory extends Controller
{
    //
    public function GetOutings()
    {
        $student = Session::get('user');
        $rollno = $student->rollno;
        $OutingHistory = DB::table('outing_table')->where('rollno',$rollno)->orderBy('outtime','desc')->get();
        return view('Logins.StudentPages.OutingHistory',['OutingHistory' => $OutingHistory]);
    }
}