<?php

namespace App\Http\Controllers\Logins\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Leavereq_history;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function LeaveRequests()
    {
        $admin = Session::get('user');
        $adminEmail = $admin->email;

        if ($adminEmail) 
        {
            $isFaculty=DB::table('leavereqs')->where('faculty_email', $adminEmail)->exists();
            $isWarden=DB::table('leavereqs')->where('warden_email', $adminEmail)->exists();

            if ($isFaculty) {
                session(['role' => 'faculty']);
            } elseif ($isWarden) {
                session(['role' => 'warden']);
            }
        }
        $fac_war="select * from leavereqs where faculty_email='". $adminEmail ."' or warden_email='".$adminEmail."';"; 
        $students=DB::select($fac_war);
        if($students==NULL)
            return back()->with('message','There are no pending leave requests');
        return view('Logins/AdminPages.LeaveRequest',['students'=>$students]);
    }

    public function warden_approval(Request $request,$rollno)
    {
        if($request->war_acc=="Accept")
        {
            $admin = Session::get('user');
            DB::table('leavereqs')->where('rollno',$rollno )->update(['warden' => 1]);
            $student = DB::table('leavereqs')->where('rollno', $rollno)->first();
            $result=new Leavereq_history();
            $result->rollno=$rollno;
            $result->name=$student->name;
            $result->phoneno=$student->phoneno;
            $result->placeofvisit=$student->placeofvisit;
            $result->purpose=$student->purpose;
            $result->outdate=$student->outdate;
            $result->outime=$student->outime;
            $result->indate=$student->indate;
            $result->intime=$student->intime;
            $result->noofdays=$student->noofdays;
            $result->faculty_email=$student->faculty_email;
            $result->warden_email=$student->warden_email;
            $result->warden=1;
            $result->faculty_adv=$student->faculty_adv;
            $result->status="Approved";
            $result->image=$student->image;

            $formattedOutdate = Carbon::parse($student->outdate)->format('Ymd');
            $BarcodeContent = $rollno . '_' . $formattedOutdate;

            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($BarcodeContent, $generator::TYPE_CODE_128);
            $path = 'barcodes/' . $rollno . '_' . $student->outdate . '.png';
            Storage::disk('public')->put($path, $barcode);
            //$filename = $result->rollno . '_' . $result->outdate;
            //$photoPath = $image->storeAs('barcodes', $filename, 'public');
            $result->barcode = $path;
            $result->save();
            DB::table('leavereqs')->where(['rollno'=> $rollno])->delete();
            $email=$admin->email;
            $fac_war="select * from leavereqs where faculty_email='". $email ."' or warden_email='".$email."';"; 
            $students=DB::select($fac_war);
            if($students==NULL)
                return redirect('AdminDashboard')->with('message','There are no pending leave requests');
            return back();
        }
        else
        {
            $admin = Session::get('user');
            DB::table('leavereqs')->where('rollno',$rollno)->update(['warden' =>2]);
            $student = DB::table('leavereqs')->where('rollno', $rollno)->first();
            $result=new Leavereq_history();
            $result->rollno=$rollno;
            $result->name=$student->name;
            $result->phoneno=$student->phoneno;
            $result->placeofvisit=$student->placeofvisit;
            $result->purpose=$student->purpose;
            $result->outdate=$student->outdate;
            $result->outime=$student->outime;
            $result->indate=$student->indate;
            $result->intime=$student->intime;
            $result->noofdays=$student->noofdays;
            $result->faculty_adv=$student->faculty_adv;
            $result->faculty_email=$student->faculty_email;
            $result->warden_email=$student->warden_email;
            $result->warden=2;
            $result->status="Declined";
            $result->image=$student->image;
            $result->save();
            DB::table('leavereqs')->where(['rollno'=> $rollno])->delete();
            $email=$admin->email;
            $fac_war="select * from leavereqs where faculty_email='". $email ."' or warden_email='".$email."';"; 
            $students=DB::select($fac_war);
            if($students==NULL)
                return redirect('AdminDashboard')->with('message','There are no pending leave requests');
            return back();
        }
    }
    
    public function faculty_approval(Request $request,$rollno)
    {
        if($request->fac_acc=="Accept")
        {
            DB::table('leavereqs')->where('rollno',$rollno)->update(['faculty_adv' =>1]);
            return back();
        }   
        else
        {
            $admin = Session::get('user');
            DB::table('leavereqs')->where('rollno',$rollno)->update(['faculty_adv' =>2]);
            $student = DB::table('leavereqs')->where('rollno', $rollno)->first();
            $result=new Leavereq_history();
            $result->rollno=$rollno;
            $result->name=$student->name;
            $result->phoneno=$student->phoneno;
            $result->placeofvisit=$student->placeofvisit;
            $result->purpose=$student->purpose;
            $result->outdate=$student->outdate;
            $result->outime=$student->outime;
            $result->indate=$student->indate;
            $result->intime=$student->intime;
            $result->noofdays=$student->noofdays;
            $result->warden=$student->warden;
            $result->faculty_email=$student->faculty_email;
            $result->warden_email=$student->warden_email;
            $result->faculty_adv=2;
            $result->status="Declined";
            $result->image=$student->image;
            $result->save();
            DB::table('leavereqs')->where(['rollno'=> $rollno])->delete();
            $email=$admin->email;
            $fac_war="select * from leavereqs where faculty_email='". $email ."' or warden_email='".$email."';"; 
            $students=DB::select($fac_war);
            if($students==NULL)
                return redirect('AdminDashboard')->with('message','There are no pending leave requests');
            return back();
        }
    }
    public function show_leave_det()
    {
        $admin = Session::get('user');
        $email=$admin->email;
        $students = DB::select("select * from leavereq_histories where faculty_email='". $email ."' or warden_email='".$email."' order by outdate desc;");
        return view('Logins.AdminPages.LeaveReqHistory',['students'=>$students]);
    }
}
