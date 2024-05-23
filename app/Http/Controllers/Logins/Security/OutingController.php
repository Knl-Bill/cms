<?php

namespace App\Http\Controllers\Logins\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class OutingController extends Controller
{
    //
    public function InsertOuting(Request $request)
    {
        $request->validate([
            'rollno' => 'required|string'
        ]);
        
        $rollno = strtoupper($request->input('rollno'));

        $student = DB::table('students')->where('rollno',$rollno)->first();

        if(!$student)
        {
            return redirect()->back()->with('error',"$rollno is not a student of NITPY");
        }

        $existingOuting = DB::table('outing__table')->where('rollno',$rollno)->whereNULL('intime')->first();
        $security = Session::get('user');
        if($security)
        {
            if($existingOuting)
            {
                $intime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('outing__table')->where('id',$existingOuting->id)->update(['intime' => $intime]);
                return redirect()->back()->with('success',"Outing Closed for $rollno at $intime");
            }
            else{
                $outtime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('outing__table')->insert([
                    'rollno' => $student->rollno,
                    'name' => $student->name,
                    'phoneno' => $student->phoneno,
                    'email' => $student->email,
                    'year' => $student->batch,
                    'gender' => $student->gender,
                    'hostel' => $student->hostelname,
                    'roomno' => $student->roomno,
                    'outtime' => $outtime,
                    'intime' => null,
                ]);
                return redirect()->back()->with('success',"Outing Started for $rollno at $outtime");
            }
        }
        else
            return redirect()->back()->with('error','You are Logged-in as a Guest');
    }
    public function OutingStatus()
    {
        $security = Session::get('user');
        if($security)
        {
            $OutingHistory = DB::table('outing__table')->orderBy('outtime','desc')->get(); 
            $name = "Outing History";
            return view('Logins.SecurityPages.Outing.OutingHistory',['OutingHistory' => $OutingHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
    public function UnclosedOuting()
    {
        $security = Session::get('user');
        if($security)
        {
            $OutingHistory = DB::table('outing__table')->whereNULL('intime')->orderBy('outtime','desc')->get(); 
            $name = "Unclosed Outing";
            return view('Logins.SecurityPages.Outing.OutingHistory',['OutingHistory' => $OutingHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
    public function BoysOuting()
    {
        $security = Session::get('user');
        if($security)
        {
            $gender = "MALE";
            $OutingHistory = DB::table('outing__table')->where('gender',$gender)->orderBy('outtime','desc')->get(); 
            $name = "Boys Outing";
            return view('Logins.SecurityPages.Outing.OutingHistory',['OutingHistory' => $OutingHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
    public function GirlsOuting()
    {
        $security = Session::get('user');
        if($security)
        {
            $gender = "FEMALE";
            $OutingHistory = DB::table('outing__table')->where('gender',$gender)->orderBy('outtime','desc')->get(); 
            $name = "Girls Outing";
            return view('Logins.SecurityPages.Outing.OutingHistory',['OutingHistory' => $OutingHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
}
