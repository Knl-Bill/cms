<?php

namespace App\Http\Controllers;

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
        return view('Login.StudentSignUp');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
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
        return view('Logins.Student'); 
    }
    public function signup() { 
        return view('Logins.StudentSignUp'); 
    }
    public function loginfinal(Request $request) { 
        $rollno = $request->input('rollno');
        if(DB::table('students')->where('rollno',$rollno)->exists())
        {
            $password= $request->input('password');
            
            $user = DB::table('students')->where('rollno', $rollno)->value('password');
            // echo  $hashedpassword;
            // echo '\n';
            // echo $user->password;
            if(HASH::check($password,$user))
            {
                return view('stu_dashboard');
            }
            else
            {
                echo 'Wrong password';
            }
            
        }
        else
            echo 'User not found';
    }  
       
    
}
