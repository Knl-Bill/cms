<?php

namespace App\Http\Controllers\Logins\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LeaveController extends Controller
{
    //
    public function InsertLeave(Request $request)
    {
        $request->validate([
            'rollno' => 'required|string',
            'outdate' => 'required|date',
            'gate' => 'required|string'
        ]);
        $security = Session::get('user');
        if($security)
        {
            $rollno = strtoupper($request->input('rollno'));
            $outdate = $request->input('outdate');
            $gate = $request->input('gate');
            $student = DB::table('leavereq_histories')->where('rollno',$rollno)->where('outdate',$outdate)->where('status','Approved')->first();

            if(!$student)
            {
                return redirect()->back()->with('error',"$rollno has no approved leave requests");
            }

            $existingLeave = DB::table('leavehistory')->where('rollno',$rollno)->whereNULL('intime')->first();
            
            $security_name = $security->name;
        
            if($existingLeave)
            {
                $intime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('leavehistory')->where('id',$existingLeave->id)->update(['intime' => $intime]);
                return redirect()->back()->with('success',"Leave Closed for $rollno at $intime");
            }
            else{
                $outtime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('leavehistory')->insert([
                    'rollno' => $student->rollno,
                    'name' => $student->name,
                    'phoneno' => $student->phoneno,
                    'placeofvisit' => $student->placeofvisit,
                    'purpose' => $student->purpose,
                    'outtime' => $outtime,
                    'intime' => null,
                    'security' => $security_name,
                    'gate' => $gate,
                ]);
                return redirect()->back()->with('success',"Leave Started for $rollno at $outtime");
            }
        }
        else
            return redirect()->back()->with('error','You are Logged-in as a Guest');
    }
    public function InsertScannerLeave(Request $request)
    {
        $request->validate([
            'rollno' => 'required|string',
            'gate' => 'required|string'
        ]);
        $BarcodeContent = $request->input('rollno');
        list($rollno, $outdate) = explode('_', $BarcodeContent);
        $outdate = Carbon::createFromFormat('Ymd',$outdate)->toDateString();

        $security = Session::get('user');
        if($security)
        {
            $gate = $request->input('gate');
            $student = DB::table('leavereq_histories')->where('rollno',$rollno)->where('outdate',$outdate)->where('status','Approved')->first();

            if(!$student)
            {
                return redirect()->back()->with('error',"$rollno has no approved leave requests");
            }

            $existingLeave = DB::table('leavehistory')->where('rollno',$rollno)->whereNULL('intime')->first();
            
            $security_name = $security->name;
        
            if($existingLeave)
            {
                $intime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('leavehistory')->where('id',$existingLeave->id)->update(['intime' => $intime]);
                return redirect()->back()->with('success',"Leave Closed for $rollno at $intime");
            }
            else{
                $outtime = Carbon::now()->setTimezone('Asia/Kolkata');
                DB::table('leavehistory')->insert([
                    'rollno' => $student->rollno,
                    'name' => $student->name,
                    'phoneno' => $student->phoneno,
                    'placeofvisit' => $student->placeofvisit,
                    'purpose' => $student->purpose,
                    'outtime' => $outtime,
                    'intime' => null,
                    'Security' => $security_name,
                    'gate' => $gate,
                ]);
                return redirect()->back()->with('success',"Leave Started for $rollno at $outtime");
            }
        }
        else
            return redirect()->back()->with('error','You are Logged-in as a Guest');
    }
    public function LeaveStatus()
    {
        $security = Session::get('user');
        if($security)
        {
            $LeaveHistory = DB::table('leavehistory')->orderBy('outtime','desc')->get(); 
            $name = "Leave History";
            return view('Logins.SecurityPages.Leave.LeaveHistory',['LeaveHistory' => $LeaveHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
    public function UnclosedLeaves()
    {
        $security = Session::get('user');
        if($security)
        {
            $LeaveHistory = DB::table('leavehistory')->whereNULL('intime')->orderBy('outtime','desc')->get(); 
            $name = "Unclosed Leaves";
            return view('Logins.SecurityPages.Leave.LeaveHistory',['LeaveHistory' => $LeaveHistory, 'Name' => $name]);
        }
        else{
            return redirect()->back()->with('error','You are Logged-in as a Guest');
        }
    }
}
