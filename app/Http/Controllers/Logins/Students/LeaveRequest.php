<?php

namespace App\Http\Controllers\Logins\Students;

use App\Http\Controllers\Controller;
use App\Models\Leavereq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Hash;
use Carbon\Carbon;
use File;

class LeaveRequest extends Controller
{
    public function LeaveRequestPage()
    {
        return view('Logins.StudentPages.LeaveRequest');
    }
    public function InsertLeaveRequest(Request $request)
    {
        if($request->noofdays>3)
        {
            $rules=([
                'image' => 'required',
            ]);
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return back()->withInput()->withErrors(['image' => 'E-Mail Screenshot is required for more than 3 days']);
            }
        }
        
        $user = Session::get('user');
        $result=new Leavereq();
        $result->rollno=$user->rollno;
        if (DB::table('leavereqs')->where('rollno',$user->rollno)->exists()) 
        {
            return back()->withInput()->withErrors(['rollno' => 'Already a request is pending!']);
        }
        $result->name=$user->name;
        $result->phoneno=$user->phoneno;
        $result->placeofvisit=$request->placeofvisit;
        $result->purpose=$request->purpose;
        $result->outdate=$request->outdate;
        $result->outime=$request->outime;
        $result->indate=$request->indate;
        $result->intime=$request->intime;
        $result->faculty_email=$user->faculty_advisor;
        $result->warden_email=$user->warden;
        $result->noofdays=$request->noofdays;        
        if ($request->hasFile('image')) 
        {
            $image = $request->file('image');
            $filename = $result->rollno . '_' . $result->outdate;  
            $photoPath = $image->storeAs('leavereq_emails', $filename, 'public');
        } 
        else 
        {
            $photoPath = null;
        }
        $result->image = $photoPath;
        $result->save();

        // Redirect or return a response
        return back()->with('success',"Leave Request submitted successfully.");
    }
    public function DisabledDetails()
    {
        $user = Session::get('user');
        if($user)
        {
            return response()->json([
                'rollno' => $user->rollno,
                'name' => $user->name,
                'phoneno' => $user->phoneno,
            ]);
        }
        else{
            return response()->json(['message' => 'Guest'], 401);
        }
    }

    public function show_leave_det()
    {
        $user = Session::get('user');
        $stmt="select * from leavereq_histories where rollno='". $user->rollno ."' order by outdate desc;"; 
        $students = DB::select($stmt);
        return view('Logins.StudentPages.LeaveReqHistory',['students'=>$students]);
    }
    public function show_pending_leave_det()
    {
        $user = Session::get('user');
        $stmt="select * from leavereqs where rollno='". $user->rollno ."' order by outdate desc;"; 
        $students = DB::select($stmt);
        return view('Logins.StudentPages.PendingLeaveRequest',['students'=>$students]);
    }
    public function GetLeaves()
    {
        $student = Session::get('user');
        if($student)
        {
            $rollno = $student->rollno;
            $LeaveHistory = DB::table('leavehistory')->where('rollno',$rollno)->orderBy('outtime','desc')->get();
            return view('Logins.StudentPages.LeaveHistory',['LeaveHistory' => $LeaveHistory]);
        }
    }

}