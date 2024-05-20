<?php

namespace App\Http\Controllers\Logins\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $existingOuting = DB::table('outing_table')->where('rollno',$rollno)->whereNULL('intime')->first();

        if($existingOuting)
        {
            $intime = Carbon::now()->setTimezone('Asia/Kolkata');
            DB::table('outing_table')->where('id',$existingOuting->id)->update(['intime' => $intime]);
            return redirect()->back()->with('success',"Outing Closed for $rollno at $intime");
        }
        else{
            $outtime = Carbon::now()->setTimezone('Asia/Kolkata');
            DB::table('outing_table')->insert([
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
}
