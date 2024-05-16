<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class StudentController extends Controller
{
    public function insertform()
    {
        return view('main');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:students',
            'name' => 'required|string|max:255',
            'phoneno' => 'required| min:10 |max:10| unique:students',
            'rollno'=>'required|string|min:9|max:9|unique:students',
            'password' => 'required|min:8',
            'confirmpass' => 'required|same:password',
            'course' => 'required',
            'gender' => 'required',
            'batch' => 'required',
            'dept' => 'required',
            'hostelname' => 'required',
            'roomno' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return redirect('main')->withErrors($validator)->withInput();
        }
        $rollno = $request->input('rollno');
        $name= $request->input('name');
        $phoneno= $request->input('phoneno');
        $email= $request->input('email');
        $course= $request->input('course');
        $batch= $request->input('batch');
        $dept= $request->input('dept');
        $gender= $request->input('gender');
        $hostelname= $request->input('hostelname');
        $roomno= $request->input('roomno');
        $password= $request->input('password');
        $hashedpassword=Hash::make($password);
        DB::insert('insert into students (rollno,name,phoneno,email,course,batch,dept,gender,hostelname,roomno,password) values(?,?,?,?,?,?,?,?,?,?,?)',[$rollno,$name,$phoneno,$email,$course,$batch,$dept,$gender,$hostelname,$roomno,$hashedpassword] );
        echo "Record inserted successfully.<br/>";   
    }
    public function login() { 
        return view('login'); 
    }
    public function signup() { 
        return view('main'); 
    }
    public function loginfinal(Request $request) 
    { 
        $rules = [
            'rollno'=>'required|string|min:9|max:9|exists:students',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return redirect('login')->withErrors($validator)->withInput();
        }
        else
        {
            $rollno = $request->input('rollno');
            if(DB::table('students')->where('rollno',$rollno)->exists())
            {
                $password= $request->input('password');
                $user = DB::table('students')->where('rollno', $rollno)->value('password');
                if(HASH::check($password,$user))
                    return view('stu_dashboard');
                else
                    echo 'Wrong password';
            }
        }
            
    }      
}
