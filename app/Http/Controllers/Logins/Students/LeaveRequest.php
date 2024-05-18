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
        $user = Session::get('user');
        $result=new Leavereq();
        $result->rollno=$user->rollno;
        $result->name=$user->name;
        $result->phoneno=$user->phoneno;
        $result->placeofvisit=$request->placeofvisit;
        $result->purpose=$request->purpose;
        $result->outdate=$request->outdate;
        $result->outime=$request->outime;
        $result->indate=$request->indate;
        $result->intime=$request->intime;
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
                'phoneno' => $user->phoneno
            ]);
        }
        else{
            return response()->json(['message' => 'Guest'], 401);
        }
    }

    public function show_leave_det()
    {
        $user = Session::get('user');
        $stmt="select * from leavereqs where rollno='". $user->rollno ."';"; 
        $students = DB::select($stmt);
        return view('Logins.StudentPages.LeaveReqHistory',['students'=>$students]);
    }


}